<script lang="js">
    import InputError from '@/components/InputError.svelte';
    import TextLink from '@/components/TextLink.svelte';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import AuthBase from '@/layouts/AuthLayout.svelte';
    import { useForm } from '@inertiajs/svelte';
    import { LoaderCircle, Lock, Mail } from 'lucide-svelte';

    import { Recaptcha, recaptcha, observer } from "svelte-recaptcha-v2";

    let { status, canResetPassword } = $props();
    let isMobile = window.innerWidth < 700;
    
    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    let recaptchaRef;
    let recaptchaToken = null;
    const googleRecaptchaSiteKey = "6LdgguIrAAAAAMf9PqSpqhHh48Rea9EWthpmlE1I";

    function onCaptchaReady() {
        console.log("reCAPTCHA is ready");
    }

    function onCaptchaSuccess(event) {
        recaptchaToken = event.detail;
        console.log("Token:", recaptchaToken);
    }

    function onCaptchaError() {
        console.error("reCAPTCHA error");
    }

    function onCaptchaExpire() {
        recaptchaToken = null;
        console.warn("reCAPTCHA expired");
    }

    function submit(e) {
        e.preventDefault();

        if (!recaptchaToken) {
            console.warn("Please complete the reCAPTCHA first");
            return;
        }
        console.log("Submitting form with token:", recaptchaToken);
        if (!recaptchaToken) return;
    
        $form.post(route('login'), {
            data: {
                ...$form.data(),
                'g-recaptcha-response': recaptchaToken,
            },
            onFinish: () => {
                $form.reset('password');
                recaptchaToken = null;
            },
        });
    }
</script>

<svelte:head>
    <title>Login</title>
</svelte:head>

<!-- <AuthBase title="Log in to your account" description="Enter your email and password below to log in"> -->
{#if status}
    <div>
        {status}
    </div>
{/if}

<div class="form-alignment">
    <div class="row-flex border-primary border-radius">
        {#if !isMobile}
            <img src="images/dummy.png" alt="dummy img" class="border-radius-l img-login cover">
        {/if}

        <div class="{isMobile ? '' : 'border-primary-l'}">
            <form onsubmit={submit} 
            class="padding-all bg-primary border-radius{isMobile ? '' : '-r'}">
                <div class="h1 padding-btm center-flex">Inloggen</div>
                <div class="padding-btm col-flex">
                    <Label for="email" class="baseText">Email</Label>

                    <div class="flex-s-gap align-center">
                        <Mail />
                        <Input
                            id="email"
                            type="email"
                            required
                            autofocus
                            tabindex={1}
                            autocomplete="email"
                            bind:value={$form.email}
                            placeholder="email@example.com"
                            class="baseText"
                        />
                    </div>
                    <InputError message={$form.errors.email} />
                </div>

                <div class="padding-btm col-flex">
                    <Label for="wachtwoord" class="baseText">Wachtwoord</Label>

                    <div class="flex-s-gap align-center">
                        <Lock />
                        <Input
                            id="password"
                            type="password"
                            required
                            tabindex={2}
                            autocomplete="current-password"
                            bind:value={$form.password}
                            placeholder="Password"
                        />
                    </div>
                    <InputError message={$form.errors.password} />
                </div>

                <Recaptcha
                    bind:this={recaptchaRef}
                    sitekey={googleRecaptchaSiteKey}
                    size="normal"
                    on:success={onCaptchaSuccess}
                    on:error={onCaptchaError}
                    on:expired={onCaptchaExpire}
                    on:ready={onCaptchaReady}
                />

                <div class="emptyGap-{isMobile ? 's' : 'm'} center-flex padding-btm">
                    {#if $form.processing}
                        <LoaderCircle class="spin" />
                    {/if}
                </div>
                            
                            
                <Button type="submit" tabindex={4} disabled={$form.processing} variant="default" size="fullWidth" class="baseText margin-btm">
                    Inloggen
                </Button>

                <div class="row-flex gap"> 
                    {#if canResetPassword}
                        <TextLink href={route('password.request')} tabindex={5} class="baseText">Wachtwoord vergeten?</TextLink>
                    {/if}
                    <TextLink href={route('register')} tabindex={5} class="baseText text-end">Nog geen account?</TextLink>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </AuthBase> -->
