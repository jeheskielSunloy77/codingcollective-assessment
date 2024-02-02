<main class="dark:bg-black">
    <div class="container mx-auto sm:px-6 lg:px-8 space-y-6 max-w-3xl py-10" x-data="{ openTab: null }">
        <h2 class="mb-2 text-lg font-semibold">Task Conditions:</h2>
        <livewire:accordion :tabs="$taskConditionsTabs" />

        <h2 class="mb-2 text-lg font-semibold">Other Features:</h2>
        <livewire:accordion :tabs="$otherFeatures" />

        <h2 class="mb-2 text-lg font-semibold">Todos:</h2>
        <livewire:accordion :tabs="$todosTabs" />
    </div>
</main>
