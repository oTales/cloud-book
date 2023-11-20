<script setup>
defineProps(['book']);
</script>

<template>
    <div class="max-w-sm">
        <img :src="book.image" :alt="book.title" />
        <h2>{{ book.title }}</h2>
        <h3>{{ book.author }}</h3>
        <p>{{ book.description }}</p>
        <form method="POST">
                <button type="submit">Alugar</button>
        </form>
    </div>
</template>
