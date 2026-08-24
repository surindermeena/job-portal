@extends('layout.app')

@section('content')

    @include('frontside.component.pageTitle', ['title' => 'Welcome ' . Auth::user()->name])

    <section>
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @if(auth()->check())
                        @include('layout.sidebar')
                    @endif
                    <div class="col-lg-9 column">
                        <div class="padding-left">
                            <div class="emply-resume-sec">
                                <h3>Received Applications</h3>

@forelse ($candidates as $candidate)
    <div class="emply-resume-list">
        <div class="emply-resume-thumb">
            <img src="{{ asset('images/resource/'.$candidate->image) }}" alt="" />
        </div>
        <div class="emply-resume-info">
            <h3><a href="#" title="">{{ $candidate->user->name }}</a></h3>
            @if($candidate->category)
                <span><i>{{ $candidate->job_title }}</i></span>
                <p><i class="la la-map-marker"></i>{{ $candidate->city ?? '' }} | {{ $candidate->country ?? '' }}</p>
            @endif
        </div>
        <div class="action-resume" data-candidate-id="{{ $candidate->id }}">
            <div class="action-center">
                <span>Action <i class="la la-angle-down"></i></span>
                <ul>
                    <li><a href="{{ route('user.download.cv', $candidate->id) }}">Download CV</a></li>
                    <li class="open-contact"><a href="#">Send a Message</a></li>
                    <li><a href="{{ route('applied.candidate.detail', $candidate->id) }}">View Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
@empty
    <div class="no-result" style="width:100%; height:400px; align-center">
        <p class="text-center">No candidates found.</p>
    </div>
@endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <!-- Message Modal -->
        <div id="messageModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h4>Send a Message</h4>
                <form id="formA14">
                    @csrf
                    <input type="hidden" name="candidate_id" id="candidateId" value="{{$candidate->id ?? 0}}">
                    <div>
                        <input type="text" name="subject" required placeholder="Subject">
                    </div>
                    <div>
                        <select id="dropstyle" name="application_status">
                            <option value="">Select application status</option>
                            <option value="submitted">Submitted</option>
                            <option value="under_review">Under Review</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="interview_scheduled">Interview Scheduled</option>
                            <option value="interviewed">Interviewed</option>
                            <option value="offered">Offered</option>
                            <option value="hired">Hired</option>
                            <option value="rejected">Rejected</option>
                            <option value="withdrawn">Withdrawn</option>
                            <option value="on_hold">On Hold</option>
                        </select>
                    </div>
                    <div>
                        <textarea name="message" required placeholder="Message"></textarea>
                    </div>
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>

    </section>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Open modal
            $('.open-contact').on('click', function (e) {
                e.preventDefault();

                // Get the candidate ID from the parent element
                var candidateId = $(this).closest('.action-resume').data('candidate-id');

                // Set the ID into the modal hidden field
                $('#candidateId').val(candidateId);

                // Show the modal
                $('#messageModal').fadeIn();
            });

            // Close modal on "X" click
            $('.close-modal').on('click', function () {
                $('#messageModal').fadeOut();
            });

            // Close modal on outside click
            $(window).on('click', function (e) {
                if ($(e.target).is('#messageModal')) {
                    $('#messageModal').fadeOut();
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .custom-modal {
            position: relative;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 9999;

            display: none;
            /* initially hidden */
            display: flex;
            /* flex container */
            align-items: center;
            /* vertically center */
            justify-content: center;
            /* horizontally center */
        }

        .modal-content {
            background: #ffffff;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            padding: 25px 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            font-family: Arial, sans-serif;
        }

        .close-modal {
            position: absolute;
            top: 12px;
            right: 16px;
            font-size: 20px;
            color: #888;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #000;
        }

        .modal-content h4 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }

        .modal-content label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
            color: #444;
        }

        #dropstyle {
            width: 100%;
            font-weight: 500;
            margin-bottom: 12px;
            display: block;
            color: #444;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
        }

        .modal-content input[type="text"],
        .modal-content textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .modal-content textarea {
            min-height: 100px;
            resize: vertical;
        }

        .modal-content button[type="submit"] {
            background-color: #0069d9;
            color: #fff;
            border: none;
            padding: 10px 16px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button[type="submit"]:hover {
            background-color: #0051b3;
        }
    </style>


@endpush


@push('scripts')
    <script>
        document.getElementById('formA14').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("send.message") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json' // Ensures Laravel sends JSON on validation error
                    },
                    body: formData
                });

                let result;
                try {
                    result = await response.json();
                } catch {
                    throw new Error('Server did not return valid JSON.');
                }

                if (!response.ok) {
                    // Collect and display validation errors
                    let errorList = '';
                    for (const error of Object.values(result.errors || {})) {
                        errorList += `<li>${error}</li>`;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: `<ul style="text-align:left;">${errorList}</ul>`,
                    });
                    return;
                }

                // Success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: result.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    if (result.reload) {
                        window.location.reload();
                    }
                });

                form.reset();

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong.',
                });
                console.error(error);
            }
        });
    </script>
@endpush