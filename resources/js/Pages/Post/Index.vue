<script setup>

import { ref, computed } from 'vue';
import { Link, router, usePage } from "@inertiajs/vue3";
import PostLayout from "@/Layouts/PostLayout.vue";

const { posts, pagination } = usePage().props;

const paginatedPosts = ref(posts);

const nextPage = () => {
    if (pagination.next_page_url) {
        paginatedPosts.value = [];
        return router.get(pagination.next_page_url);
    }
};

const previousPage = () => {
    if (pagination.prev_page_url) {
        paginatedPosts.value = [];
        return router.get(pagination.prev_page_url);
    }
};

const totalPages = computed(() => {
    return pagination.last_page;
});

const currentPage = computed(() => {
    return pagination.current_page;
});

const isFirstPage = computed(() => {
    return pagination.current_page === 1;
});

const isLastPage = computed(() => {
    return pagination.current_page === pagination.last_page;
});

</script>

<template>
    <PostLayout>
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Posts</h1>
        <div class="mb-4">
            <Link
                :href="route('post.create')"
                class="block px-4 py-2 bg-blue-500 rounded-full text-white text-center hover:bg-blue-600"
            >
                Add Post
            </Link>
        </div>
        <div v-if="posts">
            <div v-for="post in posts" :key="post.id" class="mb-8">
                <div class="text-xl font-semibold mb-2 border-t border-gray-400 dark:text-white dark:border-gray-100">{{ post.title }}</div>
                <div class="text-gray-600 mb-4 dark:text-gray-100">{{ post.content }}</div>
                <div class="flex items-center justify-between">
                    <Link
                        :href="route('post.show', post.id)"
                        class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-1 px-2 rounded inline-flex items-center"
                    >
                        Show
                    </Link>
                    <div class="text-gray-500 text-sm dark:text-gray-300">{{ post.date }}</div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between text-gray-500 dark:text-gray-200">
                <button @click="previousPage" :disabled="isFirstPage"
                        class="text-sm bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-1 px-2 rounded inline-flex items-center"
                        :class="{ 'cursor-not-allowed': isFirstPage }">
                    Previous
                </button>
                <span>{{ currentPage }} of {{ totalPages }}</span>
                <button @click="nextPage" :disabled="isLastPage"
                        class="text-sm bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-1 px-2 rounded inline-flex items-center"
                        :class="{ 'cursor-not-allowed': isLastPage }">
                    Next
                </button>
            </div>
        </div>
    </PostLayout>
</template>
