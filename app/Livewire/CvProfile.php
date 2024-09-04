<?php 

namespace App\Livewire;

use App\Models\OjtStudent;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CvProfile extends Component
{

    public $stud_prefix;
    public $stud_first_name;
    public $stud_middle_initial;
    public $stud_last_name;
    public $stud_suffix;
    public $stud_sex = '';
    public $stud_birthday;
    public $stud_birth_place;
    public $stud_student_telephone;
    public $stud_email;
    public $stud_junior_high_school;
    public $stud_senior_high_school;
    public $stud_university;
    public $stud_sr_code;
    public $stud_department = '';
    public $stud_expected_graduation;

    // Define validation rules
    protected $rules = [
        'stud_first_name' => 'required',
        'stud_middle_initial' => 'required',
        'stud_last_name' => 'required',
        'stud_sex' => 'required',
        'stud_birthday' => 'required',
        'stud_birth_place' => 'required',
        'stud_student_telephone' => 'required',
        'stud_email' => 'required|email',
        'stud_junior_high_school' => 'required',
        'stud_senior_high_school' => 'required',
        'stud_university' => 'required',
        'stud_sr_code' => 'required',
        'stud_department' => 'required',
        'stud_expected_graduation' => 'required',
    ];

    public function render()
    {
        return view('livewire.cv-profile');
    }

    // Method to format middle initial
    public function middle_initial_dot()
    {
        // Trim any white spaces, convert to upper case, and add a dot if not present
        $this->stud_middle_initial = trim($this->stud_middle_initial);
    
        if (!empty($this->stud_middle_initial)) {
            $this->stud_middle_initial = strtoupper($this->stud_middle_initial);
            if (substr($this->stud_middle_initial, -1) !== '.') {
                    $this->stud_middle_initial .= '.';
            }
        }
    }

    public function saveStudent()
    {
        
        $this->middle_initial_dot();

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
            'stud_sr_code' => 'required|string|max:255',
            'stud_department' => 'required|string|max:255',
            'stud_expected_graduation' => 'required|string|max:255',
        ]); 

        // Get the authenticated user
        $currentUserId = auth()->user();

        // Check if the user already has a student record
        $existingStudent = OjtStudent::where('user_id', $currentUserId->id)->first();


        $studentData = [
            'user_id' => $currentUserId->id,
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
            'stud_sr_code' => $this->stud_sr_code,
            'stud_department' => $this->stud_department,
            'stud_expected_graduation' => $this->stud_expected_graduation,
        ];

        if ($existingStudent) {
            $existingStudent->update($studentData);
            session()->flash('status', 'Information successfully updated.');
        } else {
        OjtStudent::create($studentData);
        }

        session()->flash('status', 'Information successfully saved.');

        return $this->redirect('/cv-profile-page');
    }

    protected function messages()
    {
        return [
            'stud_first_name.required' => 'Please enter your first name.',
            'stud_middle_initial.required' => 'Please enter your middle initial.',
            'stud_last_name.required' => 'Please enter your last name.',
            'stud_sex.required' => 'Please select your sex.',
            'stud_birthday.required' => 'Please enter your birth date.',
            'stud_birth_place.required' => 'Please enter your place of birth.',
            'stud_email.required' => 'Please enter your email address.',
            'stud_email.email' => 'Please enter a valid email address.',
            'stud_junior_high_school.required' => 'Please enter your junior high school',
            'stud_senior_high_school.required' => 'Please enter your senior high school ',
            'stud_university.required' => 'Please enter your university campus.',
            'stud_sr_code.required' => 'Please enter your SR-Code.',
            'stud_department.required' => 'Please select your department.',
            'stud_expected_graduation.required' => 'Please enter your expected graduation date.',
        ];
    }
}
