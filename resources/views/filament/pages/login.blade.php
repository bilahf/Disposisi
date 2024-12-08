<div>
    <div class="min-h-screen dark:!text-white p-3"
         style="background-image: url('/images/wave.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;">
        <div class="h-[20vh]"></div>
        @if (filament()->hasRegistration())
            <x-slot name="subheading">
                {{ __('filament-panels::pages/auth/login.actions.register.before') }}
                {{ $this->registerAction }}
            </x-slot>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::auth.login.form.before') }}

        <div class="grid grid-cols-3 sm:grid-cols-3 gap-3 container max-w-md mx-auto pb-10">
            <div class="flex justify-center">
                <img src="/images/simpa.png" class="w-1/4 object-contain" />
            </div>
            <div class="card dark:bg-slate-800 dark:shadow dark:shadow-white">
                <x-filament-panels::form wire:submit="authenticate" class="card-body">
                    <h1 class="text-center font-black text-xl uppercase">Login <br> Sistem informasi manajemen <br> persuratan akademik</h1>
                    <img src="/images/unmuh.png" style="width: 100px; height: 100px;" class="mx-auto object-contain" />
                    {{ $this->form }}

                    <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
                </x-filament-panels::form>
            </div>
            <div class="flex justify-center">
                <img src="/images/simpa2.png" class="w-1/4 object-contain" />
            </div>

        </div>

        <div class="grid grid-cols-1 gap-2 container max-w-md mx-auto mt-6">
            <div class="card dark:bg-slate-400 bg-opacity-50 >
                <p class="text-center font-medium">


                </p>
                <img src="/images/flow.png" class="mx-auto object-contain" />
            </div>
        </div>
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::auth.login.form.after') }}
    </div>
</div>
