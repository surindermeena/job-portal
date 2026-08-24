<ul>

    @php
        $profile = auth()->user()->role ?? null;
    @endphp

    @if ($profile === 'candidate')

        <li><a href="{{route('candidate.detail')}}" title=""><i class="la la-file-text"></i>My Profile</a></li>
        <li><a href="{{route('candidate.candidateResume')}}" title=""><i class="la la-briefcase"></i>My Resume</a></li>
        <li><a href="{{route('candidate.appliedJob')}}" title=""><i class="la la-paper-plane"></i>Applied Job</a></li>
        <li><a href="{{route('view.changePassword')}}" title=""><i class="la la-flash"></i>Change Password</a></li>

    @elseif ($profile === 'company')

        <li><a href="{{route('company.detail')}}" title=""><i class="la la-file-text"></i>My Profile</a></li>
        <li><a href="{{route('job.manageJob')}}" title=""><i class="la la-briefcase"></i>Manage Jobs</a></li>
        <li><a href="{{route('company.appliedCandidate')}}" title=""><i class="la la-paper-plane"></i>Applied candidate</a>
        </li>
        <li><a href="{{route('view.changePassword')}}" title=""><i class="la la-flash"></i>Change Password</a></li>

    @elseif ($profile === 'admin')

        <li><a href="{{route('admin.index') }}" title=""><i class="la la-user"></i> My Profile</a></li>
        <li><a href="{{route('user.index') }}" title=""><i class="la la-users"></i> User Management</a></li>
        <li><a href="{{route('category.index') }}" title=""><i class="la la-th-list"></i> Category Management</a></li>
        <li><a href="{{route('job.manageJob')}}" title=""><i class="la la-briefcase"></i> Job Management</a></li>
        <li><a href="{{route('admin.companies') }}" title=""><i class="la la-building"></i> Company Management</a></li>
        <li><a href="{{route('admin.candidates.index') }}" title=""><i class="la la-id-badge"></i> Candidates</a></li>
        <li><a href="{{route('applications.index') }}" title=""><i class="la la-file-alt"></i> Application</a></li>
        <li><a href="{{route('admin.cms') }}" title=""><i class="la la-edit"></i> CMS</a></li>
        <li><a href="{{route('admin.contactUs') }}" title=""><i class="la la-envelope"></i> Contact Us</a></li>
        <li><a href="{{route('admin.testimonial') }}" title=""><i class="la la-comment-dots"></i> Testimonial</a></li>
    @endif

    {{-- Logout --}}
    <li><a href="{{ route('logout') }}" title=""><i class="la la-sign-out-alt"></i> Logout</a></li>

</ul>