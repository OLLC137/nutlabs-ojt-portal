<!-- trainee-report.blade.php -->
<div class="journal-view-page">
    <header class="journal-page-header">
        <div class="journal-page-header-top">
            <img src="{{ asset('storage/journal/logo.png') }}" alt="Batangas State University Logo">
            <div class="journal-page-header-texts">
                <p class="journal-header-12 journal-header-bold">Republic of the Philippines</p>
                <p class="journal-header-16 journal-header-bold">BATANGAS STATE UNIVERSITY</p>
                <p class="journal-header-12 journal-header-bold journal-header-red">The National Engineering University
                </p>
                <p class="journal-header-12 journal-header-bold">Alangilan Campus</p>
                <p class="journal-header-10 journal-header-bold">Golden Country Homes, Alangilan Batangas City,
                    Batangas, Philippines 4200</p>
                <p class="journal-header-10">Tel Nos.: (+63 43) 425-0139 local 2222 / 2223<br>
                    E-mail Address: cics.alangilan@g.batstate-u.edu.ph | Website Address: www.batstate-u.edu.ph</p>
            </div>
        </div>
        <p class="journal-view-underheader journal-header-bold journal-header-12">College of Informatics and Computing
            Sciences</p>
    </header>

    <div class="journal-view-document-title">
        <p>TRAINEE'S WEEKLY REPORT </p>
    </div>

    <div class="journal-view-input-field-area">
        <div class="journal-view-input-side">
            <p><b>Name: </b></p>
            <p class="journal-view-field">{{ $student->stud_first_name }} {{ $student->stud_middle_initial}}. {{ $student->stud_last_name }}</p>
        </div>
        <div class="journal-view-input-top">
            <p class="journal-view-field"></p>
            <p>Period Covered</p>
        </div>
        <div class="journal-view-input-top">
            <p class="journal-view-field">{{ $student->stud_department}}</p>
            <p>Department/Section</p>
        </div>
    </div>

    @php
        $iterations = 20; // Define your variable here
        $pagebreakrows = 6; 
        $i = 0;
        $dayNumber = 1;
    @endphp

    <div class="journal-view-page-table">
            <table class="table table-bordered">
                <thead>
                    <tr class="journal-table-padder">
                        <td colspan="3">Test</td>
                    </tr>
                    <tr class="=journal-view-page-table-head">
                        <th> </th>
                        <th> Training Activity </th>
                        <th> Number of Hours </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ojt_accomplishments as $journal_post)
                        @php
                            $i++;
                        @endphp
                        <tr @if($i >= ($pagebreakrows+1) && $i % ($pagebreakrows+1) == 0) class="journal-view-page-break" @endif>
                            <td width="24%">Day: {{ $dayNumber++ }}</td>
                            <td rowspan="2" width="51%"> {!! $journal_post->acc_accomplishments !!}</td>
                            <td rowspan="2" width="25%">{{ $journal_post->acc_hours }} Hours</td>
                        </tr>
                        <tr>
                            <td>Date: {{ $journal_post->acc_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>


    <div class="journal-view-input-field-area">
        <div class="journal-view-input-top">
            <p class="journal-view-by"><b>Noted by: </b></p>
            <p class="journal-view-field"></p>
            <p class="journal-view-field"></p>
            <p class="journal-signature-area">Training Supervisor <br>(Signature over Printed Name)</p>
        </div>
        <div class="journal-view-input-top">
            <p class="journal-view-by"><b>Prepared by: </b></p>
            <p class="journal-view-field">{{ $student->stud_first_name }} {{ $student->stud_middle_initial}}. {{ $student->stud_last_name }}</p>
            <p class="journal-signature-area">Student-Trainee's Signature <br>(Signature over Printed Name)</p>
        </div>
    </div>

    <footer class="journal-view-page-footer">
        Leading Innovations, Transforming Lives, Building the Nation
    </footer>
</div>
