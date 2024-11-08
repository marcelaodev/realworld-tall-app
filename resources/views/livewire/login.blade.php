<div>
    <div class="auth-page">
        <div class="container page">
            <div class="row">

                <div class="col-md-6 offset-md-3 col-xs-12">
                    <h1 class="text-xs-center">Sign in</h1>
                    <p class="text-xs-center">
                        <a wire:navigate href="{{ route('register') }}">Don't have an account?</a>
                    </p>

                    <x-validation-errors />

                    <form wire:submit='login'>
                        <fieldset class="form-group">
                            <input class="form-control form-control-lg" type="text" placeholder="Email"
                                wire:model.live='credentials.email'>
                        </fieldset>
                        <fieldset class="form-group">
                            <input class="form-control form-control-lg" type="password" placeholder="Password"
                                wire:model.live='credentials.password'>
                        </fieldset>
                        <button class="btn btn-lg btn-primary pull-xs-right">
                            Sign in
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>