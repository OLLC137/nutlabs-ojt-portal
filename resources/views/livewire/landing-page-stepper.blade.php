<div class="wrapper">
    <div class="stepper">
        @foreach([1, 2, 3] as $step)
        <input class="c-stepper__item" type="radio" id="stepper-5-{{ $step }}" name="stepper-5" wire:model="currentStep" value="{{ $step }}" />
        <div class="stepper__step">
            <h6><label class="stepper__button" for="stepper-5-{{ $step }}" wire:click="goToStep({{ $step }})">Step {{ $step }}</label></h6>
        </div>
        @endforeach
    </div>

    <div class="box-stepper-content">
        <div class="stepper-content">
            @if($currentStep == 1)
                <!-- Step 1 content -->
                <h1>Step 1: Complete your CV Profile</h1><br>
                <p>• Enter accurate personal information, including contact details or educational background.</p>
                <p>• Ensure all information is correctly entered and save your profile updates before proceeding to the next step.</p><br>
            @elseif($currentStep == 2)
                <!-- Step 2 content -->
                <h1>Step 2: Upload the Requirements</h1><br>
                <p>• After updating your CV Profile, proceed to the "Upload Requirements" section from the portal's dashboard.</p>
                <p>• Check the list of documents required for OJT application and ensure you have them ready in the specified formats (e.g., PDF, JPEG).</p>
                <p>• Upload each document according to the portal's guidelines. Verify that all documents are clear, legible, and meet the required specifications.</p>
                <p>• Once uploaded, submit your documents for review and approval by the portal administrator.</p><br>
            @elseif($currentStep == 3)
                <!-- Step 3 content -->
                <h1>Step 3: Submit your Accomplishment, Journal Viewing, and Journal Posting</h1><br>
                <p>• Upon approval of your requirements, proceed to the "Accomplishments" section of the portal.</p>
                <p>• Detail your tasks and achievements during the OJT period, emphasizing key learnings and contributions.</p>
                <p>• Access the "Journal Viewing" feature to review and reflect on entries related to your OJT experiences.</p>
                <p>• Utilize the "Journal Posting" functionality to document your reflections, insights, and challenges encountered during the training.</p>
                <p>• Carefully review all entries and ensure that your journal postings are complete and insightful. Submit them for final assessment and acknowledgment.</p><br>
            @endif
            <div class="stepper-buttons">
                @if($currentStep == 3)
                <x-template.button type="button" wire:click="getStarted" color="success" variant="" class="me-2" style="">Get Started</x-template.button>
                @endif
                @if($currentStep < 3)
                <x-template.button type="button" wire:click="nextStep" color="primary" variant="" class="me-2">Next</x-template.button>
                @endif
                @if($currentStep > 1)
                <x-template.button type="button" wire:click="previousStep" color="primary" variant="" class="me-2">Previous</x-template.button>
                @endif
            </div>
        </div>

    </div>

    <style>
        :root {
            --s-width: 900px;
            --s-gutter: 2.5rem;
            --c-accent: #eb1c24;
        }

        p {
            font-size: 18px;
        }

        .stepper-buttons {
            display: flex;
            justify-content: space-between;
            flex-direction: row-reverse
        }

        .box-stepper-content {
            display: flex;
            justify-content: center;
        }

        .stepper {
            background-color: f2edf3;
            --s-stepper-bullet: 3rem;
            --s-stepper-bullet-half: calc(var(--s-stepper-bullet) / 2);
            --step-transition: background 0.3s, color 0.3s;
            --step-content: "✔︎";
            --step-color: hsla(0, 0%, 70%, 0.555);
            --step-bar-bg: var(--c-accent);
            --step-bullet-bg: var(--step-bar-bg);
            --step-bullet-color: white;
            counter-reset: current-step;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(1px, 1fr));
            position: relative;
            z-index: 1;
        }

        .stepper[data-debug] {
            counter-reset: steps;
        }

        .stepper[data-debug]::after {
            content: "number of steps: " counter(steps);
            display: block;
            position: absolute;
            bottom: -1.5rem;
            width: 100%;
            text-align: center;
            color: hsl(40, 50%, 50%);
        }

        .stepper[data-debug] input {
            --s-separation: 1.5rem;
            position: absolute;
            display: initial;
            top: -2rem;
        }

        .stepper-content {
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .stepper-content h2 {
            margin-top: 0;
        }

        .c-stepper__item {
            counter-increment: steps;
            display: none;
        }

        .stepper__step {
            counter-increment: current-step;
        }

        .c-stepper__item:checked ~ .stepper__step {
            --step-color: hsl(0, 0%, 30%);
            --step-bar-bg: hsl(0, 0%, 40%);
            --step-bullet-bg: var(--step-bar-bg);
            --step-bullet-color: hsl(0, 0%, 20%);
            --step-content: counter(current-step);
        }

        .c-stepper__item:checked + .stepper__step {
            --step-bullet-bg: #eb1c24;
            --step-bullet-color: black;
            --step-color: black;
        }

        .stepper__button {
            position: relative;
            text-align: center;
            color: var(--step-color);
            display: block;
        }

        .stepper__button::before {
            content: var(--step-content);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto var(--s-stepper-bullet-half);
            height: var(--s-stepper-bullet);
            width: var(--s-stepper-bullet);
            border-radius: var(--s-stepper-bullet);
            transition: var(--step-transition);
            background: var(--step-bullet-bg);
            color: var(--step-bullet-color);
        }

        .stepper__button::after {
            content: "";
            position: absolute;
            width: 100%;
            height: calc(var(--s-stepper-bullet-half) / 2);
            background: var(--step-bar-bg);
            transition: var(--step-transition);
            top: var(--s-stepper-bullet-half);
            left: 50%;
            transform: translate(0, -50%);
            z-index: -1;
        }

        .stepper__step:last-child .stepper__button::after {
            display: none;
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background: var(--c-background);
        }

        .container,
        .container__item {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .container__item {
            padding: var(--s-gutter) calc(50% - var(--s-width) / 2);
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
        }

        .container__item h2 {
            padding: calc(var(--s-gutter) / 2) var(--s-gutter) var(--s-gutter);
            margin: 0;
            text-transform: uppercase;
            font-weight: 100;
            color: hsl(213, 15%, 60%);
            font-size: 1.4rem;
        }
    </style>

</div>

