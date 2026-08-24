<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $user->user->name }} - CV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
            font-size: 13px;
            color: #333;
            margin: 30px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }

        .profile-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }

        .user-name {
            font-size: 22px;
            font-weight: bold;
            color: #222;
        }

        .user-email {
            font-size: 14px;
            color: #555;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #0056b3;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px 0;
        }

        .label {
            font-weight: bold;
            width: 150px;
            color: #333;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        li {
            margin-bottom: 4px;
        }
    </style>
</head>

<body>

    <!-- HEADER (Image + Name + Email) -->
    <table class="header-table">
        <tr>
            <td style="width: 120px; text-align: center;">
                <img src="{{ public_path('images/resource/' . ($user->image ?? 'default.png')) }}" class="profile-img"
                    alt="Profile Image">
            </td>
            <td style="vertical-align: middle;">
                <div class="user-name">Full Name : {{ $user->user->name }}</div>
                <div class="user-email">Email : {{ $user->user->email }}</div>
            </td>
        </tr>
    </table>

    @if($user->user->name)

        <!-- Professional Details -->
        <div class="section">
            <div class="section-title">Professional Details</div>
            <table class="info-table">
                <tr>
                    <td class="label">Job Title:</td>
                    <td>{{ $user->job_title }}</td>
                </tr>
                <tr>
                    <td class="label">Experience:</td>
                    <td>{{ $user->experience }}</td>
                </tr>
                <tr>
                    <td class="label">Salary Expectation:</td>
                    <td>{{ number_format($user->min_salary, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Skills -->
        <div class="section">
            <div class="section-title">Candidate Skills</div>
            <ul>
                @foreach($user->skills as $skill)
                    <li>{{ $skill->name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Education -->
        <div class="section">
            <div class="section-title">Candidate Education</div>
            <ul>
                @foreach($user->education as $edu)
                    <li>
                        {{ $edu->degree }} — {{ $edu->institute }} ({{ $edu->year }})
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Languages -->
        <div class="section">
            <div class="section-title">Candidate Languages</div>
            <ul>
                @foreach($user->languages as $lang)
                    <li>{{ $lang->language }} — {{ $lang->level }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Address -->
        <div class="section">
            <div class="section-title">Candidate Address</div>
            <table class="info-table">
                <tr>
                    <td class="label">Address:</td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td class="label">City:</td>
                    <td>{{ $user->city }} - {{ $user->pin }}</td>
                </tr>
                <tr>
                    <td class="label">State:</td>
                    <td>{{ $user->state }}</td>
                </tr>
                <tr>
                    <td class="label">Country:</td>
                    <td>{{ $user->country }}</td>
                </tr>
            </table>
        </div>

    @endif

</body>

</html>