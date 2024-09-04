<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                            <h2>Edit Personal Information</h2>
                            <form wire:submit="save">
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Prefix') }}" type="text" id="prefix" wire:model="stud_prefix"/>
                                </div>

                                <div>
                                    @error('stud_first_name') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('First Name') }}" type="text" id="first_name" wire:model="stud_first_name"/>
                                </div>

                                <div>
                                    @error('stud_middle_initial') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Middle Initial') }}" type="text" id="middle_initial" wire:model="stud_middle_initial"/>
                                </div>
                                
                                <div>
                                    @error('stud_last_name') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Last Name') }}" type="text" id="last_name" wire:model="stud_last_name"/>
                                </div>

                                <div>
                                    @error('stud_suffix') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Suffix') }}" type="text" id="suffix" wire:model="stud_suffix"/>
                                </div>
                                
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
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Date of Birth') }}" type="date" id="birthday" wire:model="stud_birthday"/>
                                </div>
                                
                                <div>
                                    @error('stud_birth_place') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Place of Birth') }}" type="text" id="birth_place" wire:model="stud_birth_place"/>
                                </div>

                                <div>
                                    @error('stud_student_telephone') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Tel. No.') }}" type="text" id="student_telephone" wire:model="stud_student_telephone"/>
                                </div>

                                <div>
                                    @error('stud_email') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Email') }}" type="email" id="email" wire:model="stud_email"/>
                                </div>
                                
                            </form>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                    <tr>
                        <td colspan="4">
                            <h2>Edit Educational Background</h2>
                            <form wire:submit="save">
                                <div>
                                    @error('stud_junior_high_school') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Junior High School') }}" type="text" id="junior_high_school" wire:model="stud_junior_high_school"/>
                                </div>
                                
                                <div>
                                    @error('stud_senior_high_school') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Senior High School') }}" type="text" id="senior_high_school" wire:model="stud_senior_high_school"/>
                                </div>
                                
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
                                    @error('stud_sr_code') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('SR-Code') }}" type="text" id="sr_code" wire:model="stud_sr_code"/>
                                </div>
                            
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
                                <div>
                                    <x-template.input view="horizontal" text="{{ __('Expected Grad.') }}" placeholder="Month/Year" type="string" wire:model="stud_expected_graduation" />
                                </div>
                                
                            </form>
                        </td>
                    </tr>
            </x-template.card-body>
        </x-template.card>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <x-template.button type="submit" color="primary" class="me-2" wire:click="save">Save</x-template.button>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        // Set the timer for 5 seconds (5000 milliseconds)
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
