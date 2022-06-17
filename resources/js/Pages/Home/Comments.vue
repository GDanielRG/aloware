<template>
  <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
    <div class="divide-y divide-gray-200">
      <div class="px-4 py-5 sm:px-6 bg-blue-600">
        <h2 id="notes-title" class="text-lg font-medium text-blue-100">
          Comments
        </h2>
      </div>
      <div class="px-4 py-6 sm:px-6">
        <div v-if="!comments.length">
          There are no comments. A perfect opportunity to start a conversation.
        </div>
        <CommentsList @reply="setCommentToReply" :comments="comments" />
      </div>
    </div>
    <CommentForm
      @clearReply="commentToReply = null"
      :commentToReply="commentToReply"
    />
  </div>
</template>

<script setup>
import { ref } from "vue";
import CommentsList from "@/Pages/Home/CommentsList";
import CommentForm from "@/Pages/Home/CommentForm";

const props = defineProps({
  comments: Array,
});
const commentToReply = ref(null);
const setCommentToReply = (comment) => {
  commentToReply.value = comment;
};
</script>