<script setup>

defineProps(['book']);

</script>

<template>

    <div class="max-w-sm">
        <img :src="book.image" :alt="book.title" />
        <h2>{{ book.title }}</h2>
        <h3>{{ book.author }}</h3>
        <p class="mb-3">{{ book.description }}</p>
        <a class="mt-4 px-4 py-2 bg-blue-500 rounded-lg" :href="route('books.show',book.id)">Ver Detalhes</a>
    </div>
</template>


