<script setup>
import BookUser from "@/Pages/BookUser.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Books from "@/Pages/Books.vue";

defineProps(['books']);
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex gap-10 flex-wrap p-3 items-center m-auto justify-center">
            <BookUser
                v-for="(book,index) in books"
                :key="index"
                :book="book"
            />
        </div>
    </AuthenticatedLayout>
</template>
```
