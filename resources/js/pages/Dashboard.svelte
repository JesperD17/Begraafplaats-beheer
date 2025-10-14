<script lang="js">
    import PlaceholderPattern from '@/components/PlaceholderPattern.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';

    const breadcrumbs = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
    ];

    // example fetch to check user role
    let userRole = 'Loading...';

    async function fetchUserRole() {
        try {
            const response = await fetch('/checkRole', {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'include',
            });

            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            const data = await response.json();
            userRole = `User Role: ${data.role_name}`;
        } catch (error) {
            console.error(error);
            userRole = 'Error fetching user role';
        }
    }
    fetchUserRole();
</script>

<svelte:head>
    <title>Dashboard</title>
</svelte:head>

<AppLayout {breadcrumbs}>
    <div>
        {userRole}
    </div>
</AppLayout>
