<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register · MESH BN</title>

        <!-- Favicons -->
        <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="icon">
        <link href="<?php echo e(asset('assets/img/logo.png')); ?>" rel="apple-touch-icon">

        
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

        <!-- Alpine JS Plugin: Collapse -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

        
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <style>
            [x-cloak] { display:none !important; }

            .poppins {
                font-family: "Poppins", sans-serif;
            }

            .oswald {
                font-family: "Oswald", sans-serif;
            }

            .zigZagPattern{
                background-color: #f9fafb;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='199' viewBox='0 0 100 199'%3E%3Cg fill='%239C92AC' fill-opacity='0.19'%3E%3Cpath d='M0 199V0h1v1.99L100 199h-1.12L1 4.22V199H0zM100 2h-.12l-1-2H100v2z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
            }

            .zigZagPatternDarker{
                background-color: #f9fafb;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='199' viewBox='0 0 100 199'%3E%3Cg fill='%239C92AC' fill-opacity='0.47'%3E%3Cpath d='M0 199V0h1v1.99L100 199h-1.12L1 4.22V199H0zM100 2h-.12l-1-2H100v2z'%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
            }


            .hidden {
    display: none !important;
}

.guide-popup {
    position: fixed;
    bottom: 10px;
    right: 30%;
    width: 580px;
    max-width: 70vw;
    max-height: 90vh;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.25);
    z-index: 9998;
    display: flex;
    flex-direction: column;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
}

.guide-header {
    background-color: #1a1a2e; /* header color */
    color: #ffffff;
    padding: 12px 16px;
    font-weight: 600;
    display: flex;
    align-items: center;        /* vertical alignment */
    justify-content: space-between;
    border-radius: 12px 12px 0 0;
    line-height: 1;             /* prevents vertical misalignment */
}

.guide-header span {
    font-size: 15px;
    white-space: nowrap;
}

.popup-btn {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 22px;
    line-height: 1;
    padding: 0;
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.guide-popup > * {
    pointer-events: auto;
}

.guide-minimized {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: #1a1a2e;
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    cursor: pointer;
    font-size: 14px;
    z-index: 10000;
    pointer-events: auto;
}


/* Fade animations */
.fade-in {
    animation: fadeIn 0.3s forwards;
}

.fade-out {
    animation: fadeOut 0.3s forwards;
}

@keyframes  fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes  fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(20px); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .guide-popup {
        width: 90vw;
        right: 5%;
        bottom: 20px;
    }
        .guide-minimized {
        bottom: 20px;
        left: 50%;               /* center horizontally */
        transform: translateX(-50%);
    }
}

@media (max-width: 480px) {
    .guide-popup {
        width: 95vw;
        right: 2.5%;
        bottom: 15%;
        border-radius: 8px;
    }

    .guide-header {
        padding: 10px;
        font-size: 14px;
    }

    .guide-body {
        padding: 8px;
        max-height: calc(80vh - 40px);
    }

    .guide-minimized {
        bottom: 15px;           /* move higher if needed */
        left: 30%;             /* use right positioning instead */
        transform: none;        /* reset translate */
        font-size: 12px;        /* optional: make smaller for tiny screens */
        padding: 10px 20px;
    }
}


@keyframes  fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes  fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to   { opacity: 0; transform: translateY(20px); }
}

        </style>

    </head>

    <body class="bg-gray-100 zigZagPattern relative poppins">

        
        <div class="bg-indigo-100 px-5 lg:px-20 py-2 text-center text-sm text-indigo-500 flex items-center justify-center gap-2">
            <p>Almost there! let's create your new account</p>
        </div>

        
        <?php if(Session::has('success_message') || $errors->any()): ?>

            <div class="fixed top-0 z-10 w-full
            <?php if(Session::has('success_message')): ?>
                bg-green-100 text-green-500
            <?php elseif($errors->any()): ?>
                bg-red-100 text-red-500
            <?php endif; ?>
            px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">

                <?php if(Session::has('success_message')): ?>

                    <p>Registration Successful! Welcome aboard.</p>

                    <!-- Forward user to Login page -->
                    <script>
                        setTimeout(function(){
                            window.location.href= "<?php echo e(route('login')); ?>";
                        }, 4000);
                    </script>

                <?php elseif($errors->any()): ?>

                    <p>Oops! Something went wrong. Please check your form inputs.</p>
                
                <?php endif; ?>
                
            </div>

        <?php endif; ?>

        
        <div class="hidden fixed top-0 z-10 w-full bg-green-100 text-green-500 px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">
            <p>Registration Successful! Welcome aboard.</p>
        </div>

        
        <div class="hidden fixed top-0 z-10 w-full bg-red-100 text-red-500 px-5 lg:px-20 py-2 text-center text-sm flex items-center justify-center">
            <p>Oops! Something went wrong. Please check your form inputs.</p>
        </div>

        
        <form method="post" action="<?php echo e(route('registerverify.registerverify.store')); ?>" class="px-5 lg:px-20" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            
            <div class="" x-data="{ isChecked:false, termsError:false }">

                
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center justify-between my-5">

                    
                    <a href="/">
                        <div class="flex items-center gap-1 font-semibold hover:text-gray-600">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <p>Go Back</p>
                        </div>
                    </a>

                    
                    <a href="/">
                        <div class="text-center flex items-center gap-4">
                            <div class="flex flex-col leading-none">
                                <p class="font-bold text-5xl bg-gradient-to-r from-indigo-700  to-indigo-500 text-transparent bg-clip-text">MESH</p>
                                <p class="pl-0.5 text-left text-[0.7rem] text-yellow-500 font-bold tracking-tighter drop-shadow-sm">MOE BRUNEI</p>
                            </div>

                            <div class="flex flex-col justify-center leading-none border-l-2 border-yellow-500 pl-4 font-semibold text-xs text-gray-600">
                                <p class="text-[10px] text-left">MOE</p>
                                <p class=" text-sm">Employees and Services</p>
                                <p class="text-[10px] text-right ">Hub</p>
                            </div>
                        </div>
                    </a>

                </div>

                
                <div class=" grid grid-cols-4 gap-6 bg-white p-10 shadow-sm border ">

                    
                    <div class="col-span-4 mb-5">
                        <p class="text-2xl font-semibold">Registration Form</p>
                        <p class="mt-2">Please complete this form to register for your new account.</p>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-2 flex flex-col gap-2">
                        <p>Name <span class="text-red-400">*</span></p>
                        <input type="text"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300"
                        name="name" value="<?php echo e(old('name')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data>
                        <p>IC No. <span class="text-red-400">*</span></p>
                        <input type="text"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300"
                        x-mask="99999999" name="ic_no" value="<?php echo e(old('ic_no')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['ic_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2">
                        <p>Email <span class="text-red-400">*</span></p>
                        <input type="email"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300 placeholder:uppercase"
                        name="email" value="<?php echo e(old('email')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <?php
                        $departments = DB::select(DB::raw('select * from departments'));

                        // Old Value
                        $oldDepartment = null;

                        if (old('department_id')) {

                            foreach($departments as $department){

                                if($department->id == old('department_id')) {

                                    $oldDepartment = $department->label;
                                    break;

                                }
                            }

                        }
                    ?>
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data="{
                        showDropDown: false,
                        query: '<?php echo e($oldDepartment ?? ''); ?>',
                        selected: <?php echo e(old('department_id') ? 'true' : 'false'); ?>,
                        selectedId: '<?php echo e(old('department_id') ?? ''); ?>',
                        divFocused: false,
                        datas: <?php echo e(json_encode($departments)); ?>,
                        get filteredDatas() {
                            if (this.query == '') {
                                return this.datas;
                            }

                            return this.datas.filter(country => {
                                return country.label.toLowerCase().includes(this.query.toLowerCase())
                            });
                        }
                    }">

                        <div class="flex items-center justify-between">
                            <p>Jabatan <span class="text-red-400">*</span></p>
                        </div>

                        
                        <div class="relative select-none">

                            
                            <div x-cloak class="flex items-center rounded-sm border-2"
                            x-on:click="divFocused = true; showDropdown = true"
                            x-on:click.away="divFocused = false; showDropdown = false; if (!selected) { query = ''; }"
                            :class="divFocused ? 'border-indigo-400':'border-gray-200'">

                                <input x-model="query" x-on:click="showDropDown = true" x-on:click.away="showDropDown = false"
                                :disabled="selected" :class="selected ? 'bg-gray-100':'bg-white'"
                                class="px-3 py-3 placeholder:text-gray-300 placeholder:uppercase focus:outline-none cursor-pointer flex items-center justify-between w-full"
                                placeholder="EMPTY">

                                <div x-show="selected" x-on:click="selected = false; query = ''; selectedId = '';" class="px-4 hover:text-red-400 duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>

                            </div>

                            
                            <div x-show="showDropDown" x-cloak class="absolute z-20 max-h-60 overflow-y-auto mt-2 bg-white w-full rounded-md shadow-sm border-2 border-gray-200">

                                <template x-if="filteredDatas.length > 0">
                                    <template x-for="data in filteredDatas" :key="data.id">

                                        <div class="px-4 py-3 border-b cursor-pointer hover:bg-gray-100 duration-300 capitalize"
                                        x-on:click="query = data.label; selectedId = data.id; selected = true; showDropDown = false;">
                                            <p x-text="data.label"></p>
                                        </div>

                                    </template>
                                </template>

                                <template x-if="filteredDatas.length === 0">
                                    <div class="px-4 py-3 text-gray-500 text-center">
                                        No result found
                                    </div>
                                </template>

                            </div>

                            
                            <input type="hidden" x-model="selectedId" name="department_id" required>

                        </div>

                        
                        <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    
                    <?php
                        $employments = DB::select(DB::raw('select * from employment_statuss'));

                        // Old Value
                        $oldEmployment = null;

                        if (old('employment_status_id')) {

                            foreach($employments as $employment){

                                if($employment->id == old('employment_status_id')) {

                                    $oldEmployment = $employment->label;
                                    break;

                                }
                            }

                        }
                    ?>
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data="{
                        showDropDown: false,
                        query: '<?php echo e($oldEmployment ?? ''); ?>',
                        selected: <?php echo e(old('employment_status_id') ? 'true' : 'false'); ?>,
                        selectedId: '<?php echo e(old('employment_status_id') ?? ''); ?>',
                        divFocused: false,
                        datas: <?php echo e(json_encode($employments)); ?>,
                        get filteredDatas() {
                            if (this.query == '') {
                                return this.datas;
                            }

                            return this.datas.filter(country => {
                                return country.label.toLowerCase().includes(this.query.toLowerCase())
                            });
                        }
                    }">
                        <div class="flex items-center justify-between">
                            <p>Jenis Perkhidmatan <span class="text-red-400">*</span></p>
                        </div>

                        
                        <div class="relative select-none">

                            
                            <div x-cloak class="flex items-center rounded-sm border-2"
                            x-on:click="divFocused = true; showDropdown = true"
                            x-on:click.away="divFocused = false; showDropdown = false; if (!selected) { query = ''; }"
                            :class="divFocused ? 'border-indigo-400':'border-gray-200'">

                                <input x-model="query" x-on:click="showDropDown = true" x-on:click.away="showDropDown = false"
                                :disabled="selected" :class="selected ? 'bg-gray-100':'bg-white'"
                                class="px-3 py-3 placeholder:text-gray-300 placeholder:uppercase focus:outline-none cursor-pointer flex items-center justify-between w-full"
                                placeholder="EMPTY" required>

                                <div x-show="selected" x-on:click="selected = false; query = ''; selectedId = '';" class="px-4 hover:text-red-400 duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>

                            </div>

                            
                            <div x-show="showDropDown" x-cloak class="absolute z-20 max-h-60 overflow-y-auto mt-2 bg-white w-full rounded-md shadow-sm border-2 border-gray-200">

                                <template x-if="filteredDatas.length > 0">
                                    <template x-for="data in filteredDatas" :key="data.id">

                                        <div class="px-4 py-3 border-b cursor-pointer hover:bg-gray-100 duration-300 capitalize"
                                        x-on:click="query = data.label; selected = true; selectedId = data.id; showDropDown = false; accreditationForOther = false;">
                                            <p x-text="data.label"></p>
                                        </div>

                                    </template>
                                </template>

                                <template x-if="filteredDatas.length === 0">
                                    <div class="px-4 py-3 text-gray-500 text-center">
                                        No result found
                                    </div>
                                </template>

                            </div>

                            
                            <input type="hidden" x-model="selectedId" name="employment_status_id" required>

                        </div>

                        
                        <?php $__errorArgs = ['employment_status_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2">
                        <p>Nama Unit<span class="text-red-400">*</span></p>
                        <input type="text"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300 placeholder:uppercase"
                        name="bahagian_id" value="<?php echo e(old('bahagian_id')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['bahagian_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <?php
                        $divisions = DB::select(DB::raw('select * from divisions'));

                        // Old Value
                        $oldDivision = null;

                        if (old('division_id')) {

                            foreach($divisions as $division){

                                if($division->id == old('division_id')) {

                                    $oldDivision = $division->label;
                                    break;

                                }
                            }

                        }
                    ?>
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data="{
                        showDropDown: false,
                        query: '<?php echo e($oldDivision ?? ''); ?>',
                        selected: <?php echo e(old('division_id') ? 'true' : 'false'); ?>,
                        selectedId: '<?php echo e(old('division_id') ?? ''); ?>',
                        divFocused: false,
                        datas: <?php echo e(json_encode($divisions)); ?>,
                        get filteredDatas() {
                            if (this.query == '') {
                                return this.datas;
                            }

                            return this.datas.filter(country => {
                                return country.label.toLowerCase().includes(this.query.toLowerCase())
                            });
                        }
                    }">
                        <div class="flex items-center justify-between">
                            <p>Tangga Gaji <span class="text-red-400">*</span></p>
                        </div>

                        
                        <div class="relative select-none">

                            
                            <div x-cloak class="flex items-center rounded-sm border-2"
                            x-on:click="divFocused = true; showDropdown = true"
                            x-on:click.away="divFocused = false; showDropdown = false; if (!selected) { query = ''; }"
                            :class="divFocused ? 'border-indigo-400':'border-gray-200'">

                                <input x-model="query" x-on:click="showDropDown = true" x-on:click.away="showDropDown = false"
                                :disabled="selected" :class="selected ? 'bg-gray-100':'bg-white'"
                                class="px-3 py-3 placeholder:text-gray-300 placeholder:uppercase focus:outline-none cursor-pointer flex items-center justify-between w-full"
                                placeholder="EMPTY">

                                <div x-show="selected" x-on:click="selected = false; query = ''; selectedId = '';" class="px-4 hover:text-red-400 duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>

                            </div>

                            
                            <div x-show="showDropDown" x-cloak class="absolute z-20 max-h-60 overflow-y-auto mt-2 bg-white w-full rounded-md shadow-sm border-2 border-gray-200">

                                <template x-if="filteredDatas.length > 0">
                                    <template x-for="data in filteredDatas" :key="data.id">

                                        <div class="px-4 py-3 border-b cursor-pointer hover:bg-gray-100 duration-300 capitalize"
                                        x-on:click="query = data.label; selected = true; selectedId = data.id; showDropDown = false; accreditationForOther = false;">
                                            <p x-text="data.label"></p>
                                        </div>

                                    </template>
                                </template>

                                <template x-if="filteredDatas.length === 0">
                                    <div class="px-4 py-3 text-gray-500 text-center">
                                        No result found
                                    </div>
                                </template>

                            </div>

                            
                            <input type="hidden" x-model="selectedId" name="division_id" required>

                        </div>

                        
                        <?php $__errorArgs = ['division_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data>
                        <p>Phone Number <span class="text-red-400">*</span></p>
                        <div class="rounded-sm border-2 border-gray-200 flex items-center">
                            <p class="text-gray-300 pl-2">+673</p>
                            <input type="text" x-mask="9999999"
                            class="px-3 py-3 placeholder:text-gray-300 lowercase placeholder:uppercase focus:outline-none w-full"
                            name="telephone_mobile" value="<?php echo e(old('telephone_mobile')); ?>" placeholder="" required>
                        </div>

                        
                        <?php $__errorArgs = ['telephone_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data="{ viewPass:false }">
                        <p>Password <span class="text-red-400">*</span></p>
                        <div class="flex items-center rounded-sm border-2 border-gray-200 ">
                            <input :type="viewPass ? 'text' : 'password'"
                            class="px-3 py-3 placeholder:text-gray-300 placeholder:uppercase  w-full focus:outline-none"
                            name="password" value="<?php echo e(old('password')); ?>" placeholder="EMPTY" required>

                            
                            <div class="h-full cursor-pointer" x-on:click="viewPass = !viewPass">
                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? '':'hidden'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>

                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? 'hidden':''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </div>
                            </div>

                        </div>

                        
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2" x-data="{ viewPass:false }">
                        <p>Confirm Password <span class="text-red-400">*</span></p>
                        <div class="flex items-center rounded-sm border-2 border-gray-200 ">
                            <input :type="viewPass ? 'text' : 'password'"
                            class="px-3 py-3 placeholder:text-gray-300 placeholder:uppercase  w-full focus:outline-none"
                            name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" placeholder="EMPTY" required>

                            
                            <div class="h-full cursor-pointer" x-on:click="viewPass = !viewPass">
                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? '':'hidden'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>

                                
                                <div class=" px-2 h-full flex items-center justify-center text-gray-300 hover:text-gray-400" :class="viewPass ? 'hidden':''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </div>
                            </div>

                        </div>

                        
                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 h-0.5 w-full bg-gray-100 my-5 mx-auto"></div>

                    
                    <div class="col-span-4 mb-5">
                        <p class="text-lg font-semibold leading-none">Verifier Details</p>
                        <p class="mt-5 text-sm text-gray-500">Note: You cannot access the system until an existing user verifies your identity.</p>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2">
                        <p>Verifier's Full Name <span class="text-red-400">*</span></p>
                        <input type="text"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300 placeholder:uppercase"
                        name="ap1_name" value="<?php echo e(old('ap1_name')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['ap1_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-1 flex flex-col gap-2">
                        <p>Verifier's Email Address <span class="text-red-400">*</span></p>
                        <input type="email"
                        class="px-3 py-3 rounded-sm border-2 border-gray-200 focus:outline-indigo-400 placeholder:text-gray-300 placeholder:uppercase"
                        name="ap1_email" value="<?php echo e(old('ap1_email')); ?>" placeholder="EMPTY" required>

                        
                        <?php $__errorArgs = ['ap1_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="col-span-4 h-0.5 w-full bg-gray-100 my-5 mx-auto"></div>

                    
                    <div class="col-span-4 text-lg font-semibold">
                        <p class="leading-none">Terms and Conditions</p>
                    </div>

                    
                    <div class="col-span-4 lg:col-span-2 flex flex-col gap-4 mb-5">

                        <p x-show="termsError" x-cloak class="text-red-600 text-sm">Please agree before submitting.</p>

                        
                        <div class="flex items-center gap-2" x-on:click="isChecked = !isChecked">

                            
                            <div class="flex items-center gap-2 border-2 border-gray-200 p-0.5 text-white rounded-md overflow-hidden"
                            :class="isChecked ? 'border-indigo-600 bg-indigo-600' : '' ">

                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 -rotate-12">
                                    <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                </svg>

                            </div>

                            <p class="cursor-pointer">I agree and accept the <a href="/terms"><span class="text-indigo-700">terms and conditions</span></a>.</p>

                            
                            <input type="hidden" name="terms" :value="isChecked ? 'true' : 'false'" required />

                        </div>

                        
                        <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>

                
                <div class="col-span-4 my-10 flex items-center justify-between w-full gap-6 drop-shadow-lg">

                    
                    <a href="/">
                        <div class="flex items-center gap-1 font-semibold text-gray-400">
                            <p>CANCEL</p>
                        </div>
                    </a>

                    
                    <div class="flex justify-end uppercase overflow-hidden">

                        <button type="submit"
                        x-on:click.prevent="if (!isChecked) { termsError = true } else { $el.closest('form').submit(); }"
                        class="group relative px-9 py-3 bg-indigo-700 hover:bg-indigo-500 border border-indigo-400 rounded-tr-xl
                        rounded-bl-xl rounded-br-xl text-white flex items-center gap-2 justify-center duration-500 cursor-pointer">

                            <p>Submit</p>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                            </svg>

                            

                            <style>
                                @keyframes  slow-spin {
                                    0% { transform: rotate(0deg); }
                                    100% { transform: rotate(360deg); }
                                }
                                .animate-slow-spin {
                                    animation: slow-spin 10s linear infinite; /* Adjust the duration here */
                                }
                            </style>

                            
                            <div class="absolute z-10 flex items-center justify-center animate-slow-spin self-center duration-1000">
                                <div class="absolute left-0  rounded-full p-8 bg-white/10"></div>
                                <div class="absolute right-0 rounded-full p-8 bg-white/10"></div>
                                <div class="absolute top-5 left-0 rounded-full p-8 bg-white/5"></div>
                                <div class="absolute bottom-5 right-0 rounded-full p-8 bg-white/5"></div>
                            </div>

                        </button>

                    </div>

                </div>

            </div>

        </form>

        
<!-- Popup Window -->
<div id="guidePopup" class="guide-popup hidden">
    <div class="guide-header">
        <span>Panduan Pendaftaran Mesh</span>
        <div>
            <button id="minimizeGuideBtn" class="popup-btn">—</button>
        </div>
    </div>

    <div class="guide-body">
        <img src="<?php echo e(asset('Panduan_Pendaftaran_Mesh.png')); ?>"
        alt="Panduan Pendaftaran"
        style="width:100%; height:auto; border-radius:8px;">
    </div>
</div>

<!-- Minimized floating icon -->
<div id="guideMinimized" class="guide-minimized hidden">
📄 Registration Guide
</div>

<script>
(function () {
  // Safe element getter with helpful console warnings
  function $(id) {
    const el = document.getElementById(id);
    if (!el) console.warn(`[guide-popup] Element with id="${id}" not found.`);
    return el;
  }

  // Wait for DOM content to be ready
  function onReady(fn) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn);
    } else {
      fn();
    }
  }

  onReady(() => {
    const popup = $('guidePopup');
    const minimized = $('guideMinimized');
    const openBtn = $('openGuideBtn');
    const closeBtn = $('closeGuideBtn');
    const minimizeBtn = $('minimizeGuideBtn');

    // If popup isn't on the page, nothing to do
    if (!popup) return;

    // helper: force reflow so CSS animations always run
    function forceReflow(el) {
      void (el.offsetHeight); // read layout to force reflow
    }

    // show popup with fade-in
    function showPopup() {
      // remove any fade-out class
      popup.classList.remove('fade-out');

      // un-hide (remove display:none) BEFORE adding animation
      popup.classList.remove('hidden');

      // force reflow so animation triggers
      forceReflow(popup);

      // add fade-in
      popup.classList.add('fade-in');

      if (minimized) {
        minimized.classList.add('hidden');
        minimized.classList.remove('fade-in', 'fade-out');
      }
    }

    // hide with fade-out
    function hidePopup() {
      popup.classList.remove('fade-in');
      popup.classList.add('fade-out');

      // after animation ends, set display none
      popup.addEventListener('animationend', function handler() {
        // only hide if fade-out completed
        if (popup.classList.contains('fade-out')) {
          popup.classList.add('hidden');
        }
        popup.removeEventListener('animationend', handler);
      });
    }

    // minimize: hide then show minimized control
    function minimizePopup() {
      hidePopup();

      if (!minimized) return;

      // show minimized after fade-out completes
      // use animationend on popup to be robust
      popup.addEventListener('animationend', function handler() {
        if (popup.classList.contains('fade-out')) {
          minimized.classList.remove('hidden');
          forceReflow(minimized);
          minimized.classList.add('fade-in');
        }
        popup.removeEventListener('animationend', handler);
      });
    }

    // attach listeners safely (only if element exists)
    if (openBtn) openBtn.addEventListener('click', showPopup);
    if (closeBtn) closeBtn.addEventListener('click', hidePopup);
    if (minimizeBtn) minimizeBtn.addEventListener('click', minimizePopup);
    if (minimized) minimized.addEventListener('click', showPopup);

    // Auto-open behavior (only if user hasn't dismissed during this session)
    try {
      const DO_AUTO_OPEN = true; // toggle to false to disable auto-open
      const AUTO_OPEN_DELAY_MS = 700; // delay to make it feel natural

      if (DO_AUTO_OPEN) {
        // small safety delay to let the rest of the page render
        setTimeout(() => {
          try {
            showPopup();
          } catch (err) {
            console.error('[guide-popup] Failed to auto-open popup:', err);
          }
        }, AUTO_OPEN_DELAY_MS);
      }
    } catch (err) {
      console.error('[guide-popup] Auto-open error:', err);
    }
  });
})();
</script>


    </body>

</html>
<?php /**PATH S:\Mesh110626\resources\views/register.blade.php ENDPATH**/ ?>