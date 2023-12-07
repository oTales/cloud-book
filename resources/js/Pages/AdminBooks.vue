<script setup>
defineProps(['books']);
</script>

<template>
    <ul class="flex">
        <div>
            <li>
                <img :src="book.image" :alt="book.title" />
            </li>
            <li>
                <h2>{{ book.title }}</h2>
                <h3>{{ book.author }}</h3>
                <p>{{ book.description }}</p>
            </li>
        </div>
        <div>
            <li>Update</li>
            <li>Delete</li>
        </div>
    </ul>

</template>
