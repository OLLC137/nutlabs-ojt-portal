<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtStudent;

class EditCv extends Component
{
    public $student;
    public $stud_prefix;
    public $stud_first_name;
    public $stud_middle_initial;
    public $stud_last_name;
    public $stud_suffix;
    public $stud_sex;
    public $stud_birthday;
    public $stud_birth_place;
    public $stud_student_telephone;
    public $stud_email;
    public $stud_junior_high_school;
    public $stud_senior_high_school;
    public $stud_university;
    public $stud_year_level;
    public $stud_sr_code;
    public $stud_department;
    public $stud_expected_graduation;

    public function mount()
    {
        // Get the authenticated user's student record
        $currentUserId = auth()->id();
        $this->student = OjtStudent::where('user_id', $currentUserId)->first();

        // Initialize the form with the student data
        if ($this->student) {
            $this->loadStudentData($this->student);
        }
    }

    // Load student data into component properties
    public function loadStudentData($student)
    {
        $this->stud_prefix = $student->stud_prefix;
        $this->stud_first_name = $student->stud_first_name;
        $this->stud_middle_initial = $student->stud_middle_initial;
        $this->stud_last_name = $student->stud_last_name;
        $this->stud_suffix = $student->stud_suffix;
        $this->stud_sex = $student->stud_sex;
        $this->stud_birthday = $student->stud_birthday;
        $this->stud_birth_place = $student->stud_birth_place;
        $this->stud_student_telephone = $student->stud_student_telephone;
        $this->stud_email = $student->stud_email;
        $this->stud_junior_high_school = $student->stud_junior_high_school;
        $this->stud_senior_high_school = $student->stud_senior_high_school;
        $this->stud_university = $student->stud_university;
        $this->stud_year_level = $student->stud_year_level;
        $this->stud_sr_code = $student->stud_sr_code;
        $this->stud_department = $student->stud_department;
        $this->stud_expected_graduation = $student->stud_expected_graduation;
    }

    // Method to save the updated student data
    public function save()
    {
        // Validate the inputs
        $this->validate([
            'stud_prefix' => 'nullable|string|max:255',
            'stud_first_name' => 'required|string|max:255',
            'stud_middle_initial' => 'nullable|string|max:20',
            'stud_last_name' => 'required|string|max:255',
            'stud_suffix' => 'nullable|string|max:255',
            'stud_sex' => 'required|string|max:255',
            'stud_birthday' => 'required|date',
            'stud_birth_place' => 'required|string|max:255',
            'stud_student_telephone' => 'required|string|max:20',
            'stud_email' => 'required|email|max:255',
            'stud_junior_high_school' => 'required|string|max:255',
            'stud_senior_high_school' => 'required|string|max:255',
            'stud_university' => 'required|string|max:255',
            'stud_year_level' => 'required|string|max:255',
            'stud_sr_code' => 'required|string|max:255',
            'stud_department' => 'required|string|max:255',
            'stud_expected_graduation' => 'required|string|max:255',
        ]);

        // Update the student
        if ($this->student) {
            $this->student->update([
                'stud_prefix' => $this->stud_prefix,
                'stud_first_name' => $this->stud_first_name,
                'stud_middle_initial' => $this->stud_middle_initial,
                'stud_last_name' => $this->stud_last_name,
                'stud_suffix' => $this->stud_suffix,
                'stud_sex' => $this->stud_sex,
                'stud_birthday' => $this->stud_birthday,
                'stud_birth_place' => $this->stud_birth_place,
                'stud_student_telephone' => $this->stud_student_telephone,
                'stud_email' => $this->stud_email,
                'stud_junior_high_school' => $this->stud_junior_high_school,
                'stud_senior_high_school' => $this->stud_senior_high_school,
                'stud_university' => $this->stud_university,
                'stud_year_level' => $this->stud_year_level,
                'stud_sr_code' => $this->stud_sr_code,
                'stud_department' => $this->stud_department,
                'stud_expected_graduation' => $this->stud_expected_graduation,
            ]);

            session()->flash('status', 'Information successfully updated.');

            return $this->redirect('/edit-cv-page');
        }
    }

    public function render()
    {
        return view('livewire.edit-cv', ['student' => $this->student]);
    }
}
