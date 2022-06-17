<template>
  <BlogPost />
  <Comments :comments="comments" class="max-w-2xl mx-auto mb-12" />
</template>

<script setup>
import Comments from "@/Pages/Home/Comments";
import BlogPost from "@/Pages/Home/BlogPost";
const props = defineProps({
  comments: Array,
});
</script>
