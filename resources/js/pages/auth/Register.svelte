<script lang="ts">
    import InputError from '@/components/InputError.svelte';
    import TextLink from '@/components/TextLink.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import AuthBase from '@/layouts/AuthLayout.svelte';
    import { useForm } from '@inertiajs/svelte';
    import { LoaderCircle } from 'lucide-svelte';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        $form.post(route('register'), {
            onFinish: () => $form.reset('password', 'password_confirmation'),
        });
    };
</script>

<svelte:head>
    <title>Regristreren</title>
</svelte:head>

<!-- <AuthBase title="Create an account" description="Enter your details below to create your account"> -->
    <form onsubmit={submit}>
        <div>
            <div>
                <Label for="name">Naam</Label>
                <Input id="name" type="text" required autofocus tabindex={1} autocomplete="name" bind:value={$form.name} placeholder="Volledige" />
                <InputError message={$form.errors.name} />
            </div>

            <div>
                <Label for="email">Email adres</Label>
                <Input id="email" type="email" required tabindex={2} autocomplete="email" bind:value={$form.email} placeholder="email@example.com" />
                <InputError message={$form.errors.email} />
            </div>

            <div>
                <Label for="password">Wachtwoord</Label>
                <Input
                    id="password"
                    type="password"
                    required
                    tabindex={3}
                    autocomplete="new-password"
                    bind:value={$form.password}
                    placeholder="Wachtwoord"
                />
                <InputError message={$form.errors.password} />
            </div>

            <div>
                <Label for="password_confirmation">Bevestig wachtwoord</Label>
                <Input
                    id="password_confirmation"
                    type="password"
                    required
                    tabindex={4}
                    autocomplete="new-password"
                    bind:value={$form.password_confirmation}
                    placeholder="Bevestig wachtwoord"
                />
                <InputError message={$form.errors.password_confirmation} />
            </div>

            <Button type="submit" tabindex={5} disabled={$form.processing}>
                {#if $form.processing}
                    <LoaderCircle class="animate-spin" />
                {/if}
                Account aanmaken
            </Button>
        </div>

        <div>
            Heeft u al een account?
            <TextLink href={route('login')} tabindex={6}>Inloggen</TextLink>
        </div>
    </form>
<!-- </AuthBase> -->
