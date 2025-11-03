<script lang="js">
    import Button from "@/Components/ui/button/button.svelte";
    import AppLayout from "@/layouts/AppLayout.svelte";
    import { Link } from "@inertiajs/svelte";
    import { Loader } from "lucide-svelte";

    var location = "laden...";
    var cards = [];

    async function fetchLocations() {
        try {
            const response = await fetch(`/getCemeteries`, {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'include',
            });
            const data = await response.json();
            cards = data;
        } catch (error) {
            cards = "error";
        }
    }

    const locationPromise = (async () => {
        try {
            await fetchLocations();
            return "Nederland";
        } catch (err) {
            throw err;
        }
    })();
</script>

<svelte:head>
    Begraafplaatsen
</svelte:head>

<AppLayout>
    {#await locationPromise}
        <div class="h1 bold">
            laden...
        </div>
        <div>
            begraafplaatsen laden...
        </div>
        <div class="overlay-w-h">
            <Loader class="icon spin" />
        </div>
    {:then location}
        <div class="h1 bold">
            Kies je locatie in {location}
        </div>
        <div class="section">
            {#if cards.length > 0 && location !== "laden..."}
            <div class="flex-m-gap wrap">
                    {#each cards as card}
                        <div class="col-flex card-loc border-radius justify-between border-primary">
                            <img src="images/dummy.png" alt="dummy img" class="border-radius-t cover">
                            <div class="col-flex">
                                <div class="padding-all col-flex">
                                    <div class="center-text bold line-clamp">{card.name}</div>
                                    <div class="center-text">Locatie {card.municipality}</div>
                                </div>
                                <Button class="margin-noTop" href={`/begraafplaatsen/overzicht/${encodeURIComponent(card.name)}`}>Selecteer</Button>
                            </div>
                        </div>
                    {/each}
                </div>
            {:else}
                <div class="mt-4">
                    Geen begraafplaatsen gevonden in {location}.
                </div>
            {/if}
        </div>
    {:catch}
        <div class="h1 bold">
            Locatie onbekend
        </div>

        <div class="section">
            Er is een fout opgetreden bij het ophalen van je locatie of begraafplaatsen.
        </div>
    {/await}
</AppLayout>
