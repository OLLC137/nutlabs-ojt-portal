<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title"> Personal Information </x-slot>
                <form wire:submit="saveStudent">

                    <x-template.input view="horizontal" text="{{ __('Prefix') }}" placeholder="Prefix" type="text" wire:model="stud_prefix" />

                    <div>
                        @error('stud_first_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('First Name') }}" placeholder="First Name" type="text" wire:model="stud_first_name" />

                    <div>
                        @error('stud_middle_initial') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('M.I.') }}" placeholder="Middle Initial" type="text" wire:model="stud_middle_initial" />

                    <div>
                        @error('stud_last_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Last Name') }}" placeholder="Last Name" type="text" wire:model="stud_last_name" />

                    <x-template.input view="horizontal" text="{{ __('Suffix') }}" placeholder="Suffix" type="text" wire:model="stud_suffix" />

                    <div>
                        @error('stud_sex') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sex</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model="stud_sex">
                                    <option disabled value="" > Please Select </option>
                                    <option value="Male"> Male </option>
                                    <option value="Female"> Female </option>
                                </select>
                            </div>
                    </div>

                    <div>
                        @error('stud_birthday') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Date of Birth') }}" placeholder="Birthday" type="date" wire:model="stud_birthday" />

                    <div>
                        @error('stud_birth_place') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Place of Birth') }}" placeholder="Birth Place" type="string" wire:model="stud_birth_place" />

                    <div>
                        @error('stud_student_telephone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Tel. No.') }}" placeholder="Tel. No." type="text" wire:model="stud_student_telephone" />

                    <div>
                        @error('stud_email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Email') }}" placeholder="Email" type="email" wire:model="stud_email" />


                </form>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Educational Background</x-slot>
                <form wire:submit="saveStudent">

                    <div>
                        @error('stud_junior_high_school') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Junior HS') }}" placeholder="Junior High School" type="string" wire:model="stud_junior_high_school"/>

                    <div>
                        @error('stud_senior_high_school') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('Senior HS') }}" placeholder="Senior High School" type="string" wire:model="stud_senior_high_school"/>

                    <div>
                        @error('stud_university') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">University</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model="stud_university">
                                    <option disabled value="" > Select Campus </option>
                                    <option value="Pablo Borbon"> Pablo Borbon </option>
                                    <option value="Alangilan"> Alangilan </option>
                                    <option value="ARASOF-NASUGBU"> ARASOF-NASUGBU </option>
                                    <option value="Balayan"> Balayan </option>
                                    <option value="Lemery"> Lemery </option>
                                    <option value="Mabini"> Mabini </option>
                                    <option value="MALVAR">
                                    JPLPC-MALVAR </option>
                                    <option value="Lipa"> Lipa </option>
                                    <option value="Rosario"> Rosario </option>
                                    <option value="San Juan"> San Juan </option>
                                    <option value="Lobo"> Lobo </option>
                                </select>
                            </div>
                    </div>

                    <div>
                        @error('stud_year_level') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-template.input view="horizontal" text="{{ __('Year Level') }}" type="text" id="year_level" wire:model="stud_year_level"/>
                    </div>

                    <div>
                        @error('stud_sr_code') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <x-template.input view="horizontal" text="{{ __('SR-Code') }}" placeholder="SR-Code" type="string" wire:model="stud_sr_code"/>

                    <div>
                        @error('stud_department') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model="stud_department">
                                    <option disabled value="" > Select Department </option>
                                    <option value="COE"> COE </option>
                                    <option value="CICS"> CICS </option>
                                    <option value="CAFAD"> CAFAD </option>
                                    <option value="CET"> CET </option>
                                    <option value="CTE"> CTE </option>
                                    <option value="CAS"> CAS </option>
                                    <option value="CABEIHM"> CABEIHM </option>
                                    <option value="CONAHS"> CONAHS </option>
                                </select>
                            </div>
                    </div>


                    <div>
                    @error('stud_expected_graduation') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label">Expected Graduation</label>
                            <div class="col-sm-9">
                                <input class="form-control" aria-describedby="gradHelp" view="horizontal" text="{{ __('Expected Graduation') }}" placeholder="Month/Year" type="date" wire:model="stud_expected_graduation">
                            </div>
                            <div id="gradHelp" class="form-text d-flex justify-content" style="color: darkgray;">Put the 1st day of the Month if there's no specific date.</div>
                    </div>


                <form>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="d-flex justify-content-end">
    <x-template.button type="submit" color="primary" variant="" class="me-2"> {{ __('Submit') }} </x-template.button>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Find the flash message element
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                // Fade out and remove the flash message
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500); // Match this time with the CSS transition duration
            }
        }, 3000); // Duration to show the message
    });
</script>
