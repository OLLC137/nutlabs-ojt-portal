<div class="row">

    <div class="col-12 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title"> {{ __('Gradient buttons') }} </x-slot>
                <x-slot name="description"> Add class <code>.btn-gradient-{color}</code> for gradient buttons </x-slot>
                <x-template.button type="button" variant="gradient" color="primary" :fw="true"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="secondary" :fw="true"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="success" :fw="true"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="danger" :fw="true"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="warning" :fw="true"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="info" :fw="true"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="light" :fw="true"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="dark" :fw="true"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link" :fw="true"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>

            <x-template.card-body>
                <x-slot name="title"> {{ __('Rounded buttons') }} </x-slot>
                <x-slot name="description"> Add class <code>.btn-rounded</code> </x-slot>
                <x-template.button type="button" variant="gradient" color="primary" :rounded="true" :fw="true"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="secondary" :rounded="true" :fw="true"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="success" :rounded="true" :fw="true"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="danger" :rounded="true" :fw="true"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="warning" :rounded="true" :fw="true"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="info" :rounded="true" :fw="true"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="light" :rounded="true" :fw="true"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="dark" :rounded="true" :fw="true"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link" :fw="true"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>

            <x-template.card-body>
                <x-slot name="title">Outlined buttons</x-slot>
                <x-slot name="description">Add class <code>.btn-outline-{color}</code> for outline buttons</x-slot>
                <x-template.button type="button" variant="outline" color="primary" :fw="true"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="secondary" :fw="true"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="success" :fw="true"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="danger" :fw="true"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="warning" :fw="true"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="info" :fw="true"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="light" :fw="true" class="text-black"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" variant="outline" color="dark" :fw="true"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link" :fw="true"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>

            <x-template.card-body>
                <x-slot name="title">Single color buttons</x-slot>
                <x-slot name="description">Add class <code>.btn-{color}</code> for buttons in theme colors</x-slot>
                <x-template.button type="button" color="primary" :fw="true"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" color="secondary" :fw="true"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" color="success" :fw="true"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" color="danger" :fw="true"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" color="warning" :fw="true"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" color="info" :fw="true"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" color="light" :fw="true"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" color="dark" :fw="true"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link" :fw="true"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>

            <x-template.card-body>
                <x-slot name="title">Inverse buttons</x-slot>
                <x-slot name="description">Add class <code>.btn-inverse-{color} for inverse buttons</code></x-slot>
                <x-template.button type="button" variant="inverse" color="primary" :fw="true"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="secondary" :fw="true"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="success" :fw="true"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="danger" :fw="true"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="warning" :fw="true"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="info" :fw="true"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="light" :fw="true" class="text-black"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" variant="inverse" color="dark" :fw="true"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link" :fw="true"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>

            <x-template.card-body>
                <x-slot name="title">Normal buttons</x-slot>
                <x-slot name="description">Use any of the available button classes to quickly create a styled button.</x-slot>
                <x-template.button type="button" variant="gradient" color="primary"> {{ __('Primary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="secondary"> {{ __('Secondary') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="success"> {{ __('Success') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="danger"> {{ __('Danger') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="warning"> {{ __('Warning') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="info"> {{ __('Info') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="light"> {{ __('Light') }} </x-template.button>
                <x-template.button type="button" variant="gradient" color="dark"> {{ __('Dark') }} </x-template.button>
                <x-template.button type="button" color="link"> {{ __('Link') }} </x-template.button>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <div class="row">
                    <div class="col-md-7">
                        <x-template.card-body-item>
                            <x-slot name="title"> {{ __('Icon Buttons') }} </x-slot>
                            <x-slot name="description">Add class <code>.btn-icon</code> for buttons with only icons</x-slot>
                            <div class="template-demo d-flex justify-content-between flex-nowrap">
                                <x-template.button type="button" color="primary" variant="gradient" :rounded="true" :icon="true">
                                    <i class="mdi mdi-home-outline"></i>
                                </x-template.button>
                                <x-template.button type="button" color="dark" variant="gradient" :rounded="true" :icon="true">
                                    <i class="mdi mdi-internet-explorer"></i>
                                </x-template.button>
                                <x-template.button type="button" color="danger" variant="gradient" :rounded="true" :icon="true">
                                    <i class="mdi mdi-email-open"></i>
                                </x-template.button>
                                <x-template.button type="button" color="info" variant="gradient" :rounded="true" :icon="true">
                                    <i class="mdi mdi-star"></i>
                                </x-template.button>
                                <x-template.button type="button" color="success" variant="gradient" :rounded="true" :icon="true">
                                    <i class="mdi mdi-map-marker"></i>
                                </x-template.button>
                            </div>
                            <div class="template-demo d-flex justify-content-between flex-nowrap">
                                <x-template.button type="button" color="primary" variant="inverse" :rounded="true" :icon="true">
                                    <i class="mdi mdi-home-outline"></i>
                                </x-template.button>
                                <x-template.button type="button" color="dark" variant="inverse" :icon="true">
                                    <i class="mdi mdi-internet-explorer"></i>
                                </x-template.button>
                                <x-template.button type="button" color="danger" variant="inverse" :icon="true">
                                    <i class="mdi mdi-email-open"></i>
                                </x-template.button>
                                <x-template.button type="button" color="info" variant="inverse" :icon="true">
                                    <i class="mdi mdi-star"></i>
                                </x-template.button>
                                <x-template.button type="button" color="success" variant="inverse" :icon="true">
                                    <i class="mdi mdi-map-marker"></i>
                                </x-template.button>
                            </div>
                            <div class="template-demo d-flex justify-content-between flex-nowrap mt-4">
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-heart-outline text-danger"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-music text-dark"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-star text-primary"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-signal text-info"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-trending-up text-success"></i>
                                </x-template.button>
                            </div>
                            <div class="template-demo d-flex justify-content-between flex-nowrap">
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-heart-outline"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-music"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-star"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-signal"></i>
                                </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" :rounded="true" :icon="true">
                                    <i class="mdi mdi-trending-up"></i>
                                </x-template.button>
                            </div>
                        </x-template.card-body-item>
                    </div>
                    <div class="col-md-5">
                        <x-template.card-body-item>
                            <x-slot name="title"> {{ __('Button Size') }} </x-slot>
                            <x-slot name="description"> Use class <code>.btn-{size}</code> </x-slot>
                            <div class="template-demo">
                                <x-template.button type="button" color="secondary" variant="outline" size="lg"> btn-lg </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" size="md">btn-md</x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline" size="sm">btn-sm</x-template.button>
                            </div>
                            <div class="template-demo mt-4">
                                <x-template.button type="button" color="danger" variant="gradient" size="lg"> btn-lg </x-template.button>
                                <x-template.button type="button" color="success" variant="gradient" size="md">btn-md</x-template.button>
                                <x-template.button type="button" color="primary" variant="gradient" size="sm">btn-sm</x-template.button>
                            </div>
                        </x-template.card-body-item>
                    </div>
                </div>
            </x-template.card-body>
        </x-template.card>
    </div>


    <div class="col-md-4 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Block buttons</x-slot>
                <x-slot name="description">Add class <code>.btn-block</code></x-slot>
                <x-template.button type="button" color="info" variant="gradient" size="lg" :block="true"> Block buttons <i class="mdi mdi-menu float-right"></i> </x-template.button>
                <x-template.button type="button" color="dark" size="lg" :block="true"> Block buttons </x-template.button>
                <x-template.button type="button" color="primary" variant="gradient" size="lg" :block="true"> <i class="mdi mdi-account"></i> Block buttons </x-template.button>
                <x-template.button type="button" color="secondary" variant="outline" size="lg" :block="true"> Block buttons </x-template.button>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="col-12 grid-margin">
        <x-template.card>
            <x-template.card-body>
                <div class="row">
                    <div class="col-md-6">
                        <x-template.card-body-item>
                            <x-slot name="title">Button groups</x-slot>
                            <x-slot name="description">Wrap a series of buttons with <code>.btn</code> in <code>.btn-group</code></x-slot>
                            <x-template.btn-group>
                                <x-template.button type="button" color="secondary" variant="outline">1</x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline">2</x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline">3</x-template.button>
                            </x-template.btn-group>
                            <x-template.btn-group>
                                <x-template.button type="button" color="secondary" variant="outline"> <i class="mdi mdi-heart-outline"></i> </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline"> <i class="mdi mdi-calendar"></i> </x-template.button>
                                <x-template.button type="button" color="secondary" variant="outline"> <i class="mdi mdi-clock"></i> </x-template.button>
                            </x-template.btn-group>

                            <x-template.btn-group>
                                <x-template.button type="button" color="primary">1</x-template.button>
                                <x-template.button type="button" color="primary">2</x-template.button>
                                <x-template.button type="button" color="primary">3</x-template.button>
                            </x-template.btn-group>
                            <x-template.btn-group>
                                <x-template.button type="button" color="primary"> <i class="mdi mdi-heart-outline"></i> </x-template.button>
                                <x-template.button type="button" color="primary"> <i class="mdi mdi-calendar"></i> </x-template.button>
                                <x-template.button type="button" color="primary"> <i class="mdi mdi-clock"></i> </x-template.button>
                            </x-template.btn-group>

                            <div class="template-demo mt-4">
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-format-vertical-align-top"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-format-vertical-align-center"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-format-vertical-align-bottom"></i>
                                    </button>
                                </div>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">Default</button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">Dropdown</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item">Go back</a>
                                            <a class="dropdown-item">Delete</a>
                                            <a class="dropdown-item">Swap</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary">Default</button>
                                </div>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">Top</button>
                                    <button type="button" class="btn btn-outline-secondary">Middle</button>
                                    <button type="button" class="btn btn-outline-secondary">Bottom</button>
                                </div>
                            </div>
                            <div class="template-demo mt-4">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-star d-block mb-1"></i> Favourites </button>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-reload d-block mb-1"></i> Reload </button>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-account d-block mb-1"></i> Users </button>
                                </div>
                            </div>
                        </x-template.card-body-item>
                    </div>
                    <div class="col-md-6">
                        <h4 class="card-title">Button with text and icon</h4>
                        <p class="card-description">Wrap icon and text inside <code>.btn-icon-text</code> and use <code>.btn-icon-prepend</code> or <code>.btn-icon-append</code> for icon tags</p>
                        <div class="template-demo">
                            <button type="button" class="btn btn-gradient-primary btn-icon-text">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i> Submit </button>
                            <button type="button" class="btn btn-gradient-dark btn-icon-text"> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                            </button>
                            <button type="button" class="btn btn-gradient-success btn-icon-text">
                                <i class="mdi mdi-alert btn-icon-prepend"></i> Warning </button>
                        </div>
                        <div class="template-demo">
                            <button type="button" class="btn btn-gradient-danger btn-icon-text">
                                <i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
                            <button type="button" class="btn btn-gradient-info btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-icon-text">
                                <i class="mdi mdi-reload btn-icon-prepend"></i> Reset </button>
                        </div>
                        <div class="template-demo mt-2">
                            <button type="button" class="btn btn-outline-primary btn-icon-text">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i> Submit </button>
                            <button type="button" class="btn btn-outline-secondary btn-icon-text"> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                            </button>
                            <button type="button" class="btn btn-outline-success btn-icon-text">
                                <i class="mdi mdi-alert btn-icon-prepend"></i> Warning </button>
                        </div>
                        <div class="template-demo">
                            <button type="button" class="btn btn-outline-danger btn-icon-text">
                                <i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
                            <button type="button" class="btn btn-outline-info btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i>
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-icon-text">
                                <i class="mdi mdi-reload btn-icon-prepend"></i> Reset </button>
                        </div>
                        <div class="template-demo mt-2">
                            <button class="btn btn-outline-dark btn-icon-text">
                                <i class="mdi mdi-apple btn-icon-prepend mdi-36px"></i>
                                <span class="d-inline-block text-left">
                                    <small class="font-weight-light d-block">Available on the</small> App Store </span>
                            </button>
                            <button class="btn btn-outline-dark btn-icon-text">
                                <i class="mdi mdi-android-debug-bridge btn-icon-prepend mdi-36px"></i>
                                <span class="d-inline-block text-left">
                                    <small class="font-weight-light d-block">Get it on the</small> Google Play </span>
                            </button>
                        </div>
                    </div>
                </div>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Social Icon Buttons</h4>
                <p class="card-description">Add class <code>.btn-social-icon</code></p>
                <div class="template-demo">
                    <button type="button" class="btn btn-social-icon btn-outline-facebook"><i class="mdi mdi-facebook"></i></button>
                    <button type="button" class="btn btn-social-icon btn-outline-youtube"><i class="mdi mdi-youtube"></i></button>
                    <button type="button" class="btn btn-social-icon btn-outline-twitter"><i class="mdi mdi-twitter"></i></button>
                    <button type="button" class="btn btn-social-icon btn-outline-dribbble"><i class="mdi mdi-dribbble"></i></button>
                    <button type="button" class="btn btn-social-icon btn-outline-linkedin"><i class="mdi mdi-linkedin"></i></button>
                    <button type="button" class="btn btn-social-icon btn-outline-google"><i class="mdi mdi-google-plus"></i></button>
                </div>
                <div class="template-demo">
                    <button type="button" class="btn btn-social-icon btn-facebook"><i class="mdi mdi-facebook"></i></button>
                    <button type="button" class="btn btn-social-icon btn-youtube"><i class="mdi mdi-youtube"></i></button>
                    <button type="button" class="btn btn-social-icon btn-twitter"><i class="mdi mdi-twitter"></i></button>
                    <button type="button" class="btn btn-social-icon btn-dribbble"><i class="mdi mdi-dribbble"></i></button>
                    <button type="button" class="btn btn-social-icon btn-linkedin"><i class="mdi mdi-linkedin"></i></button>
                    <button type="button" class="btn btn-social-icon btn-google"><i class="mdi mdi-google-plus"></i></button>
                </div>
                <div class="template-demo">
                    <button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="mdi mdi-facebook"></i></button>
                    <button type="button" class="btn btn-social-icon btn-youtube btn-rounded"><i class="mdi mdi-youtube"></i></button>
                    <button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="mdi mdi-twitter"></i></button>
                    <button type="button" class="btn btn-social-icon btn-dribbble btn-rounded"><i class="mdi mdi-dribbble"></i></button>
                    <button type="button" class="btn btn-social-icon btn-linkedin btn-rounded"><i class="mdi mdi-linkedin"></i></button>
                    <button type="button" class="btn btn-social-icon btn-google btn-rounded"><i class="mdi mdi-google-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Social button with text</h4>
                <p class="card-description">Add class <code>.btn-social-icon-text</code></p>
                <div class="template-demo">
                    <button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-facebook"></i>Facebook</button>
                    <button type="button" class="btn btn-social-icon-text btn-youtube"><i class="mdi mdi-youtube"></i>Youtube</button>
                    <button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-twitter"></i>Twitter</button>
                    <button type="button" class="btn btn-social-icon-text btn-dribbble"><i class="mdi mdi-dribbble"></i>Dribbble</button>
                    <button type="button" class="btn btn-social-icon-text btn-linkedin"><i class="mdi mdi-linkedin"></i>Linkedin</button>
                    <button type="button" class="btn btn-social-icon-text btn-google"><i class="mdi mdi-google-plus"></i>Google</button>
                </div>
            </div>
        </div>
    </div>
</div>