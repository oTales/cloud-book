<script setup>

defineProps(['book']);

</script>

<template>

    <div class="max-w-sm">
    <div class="w-52">
        <img :src="book .image" :alt="book.title" class="w-48" />
        <h4 class="uppercase flex flex-wrap text-sm">{{ book.title }}</h4>
        <p class="mb-3 text-gray-400 font-light text-sm">{{ book.author }}</p>
        <a class=" px-4 py-2 bg-blue-500 rounded-lg justify-start text-white" :href="route('books.show',book.id)">Ver
            Detalhes</a>
    </div>
    </div>
</template>


