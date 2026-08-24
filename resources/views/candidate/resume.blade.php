@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'Welcome '. Auth::user()->name])

    <section>
        <div class="block remove-top">
            <div class="container">
                <div class="row no-gape">
                    @if(auth()->check())
                        @include('layout.sidebar')
                    @endif

                    <div class="col-lg-9 column">
                        <div class="padding-left">
                            <div class="manage-jobs-sec">

                                {{-- All Documents --}}
                                <div class="border-title">
                                    <h3>All Documents</h3>

                                    {{-- Upload Form --}}
                                    <form action="{{ route('documents.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="fileId"
                                            style="display: inline-block; cursor: pointer; color: #fb236a; font-size: 16px; font-weight: 500; float: right;">
                                            <i class="la la-plus" style="font-size: 18px; vertical-align: middle;"></i>
                                            Upload File
                                            <input type="file" name="fileId" id="fileId" style="display: none;"
                                                onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>

                                <div class="edu-history-sec">
                                    @forelse($documents as $document)
                                        <div class="edu-history">
                                            @php
                                              $ext = strtolower(pathinfo($document->filename, PATHINFO_EXTENSION));
                                            @endphp

                                            {{-- Show icon or image based on file extension --}}
                                            @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <i class="la la-file-image-o" style="color: #f39c12; font-size: 32px;"></i>
                                            @elseif($ext === 'pdf')
                                                <i class="la la-file-pdf-o" style="color: red; font-size: 32px;"></i>
                                            @elseif(in_array($ext, ['doc', 'docx']))
                                                <i class="la la-file-word-o" style="color: #2b579a; font-size: 32px;"></i>
                                            @else
                                                <i class="la la-file" style="font-size: 32px;"></i>
                                            @endif
                                            <div class="edu-hisinfo">
                                                <h3>{{ $document->original_name }}</h3>
                                                <i>Uploaded: {{ $document->uploaded_at->format('Y-m-d H:i') }}</i>
                                                <span>
                                                    <a class="btn btn-secondary badge"
                                                    href="{{ asset('images/resource/' . $document->filename) }}"
                                                        target="_blank">View File</a>
                                                </span>
                                                <p>Size: {{ $document->size_kb }} KB  |  Uploaded by: <strong
                                                        style="color: #fb236a;">{{ Auth::user()->name ?? 'Unknown' }}</strong>
                                                </p>
                                            </div>
                                            <ul class="action_job">
                                                <li>
                                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                                                        onsubmit="return confirm('Delete this file?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border: none; background: none;">
                                                            <i class="la la-trash-o" style="color: white; padding: 6px; font-size: 20px; border-radius: 50%; background-color: #fb236a;"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @empty
                                        <p>No documents uploaded yet.</p>
                                    @endforelse
                                </div>

                                {{-- (Leave your other static sections like Work Experience, Skills, etc.) --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection