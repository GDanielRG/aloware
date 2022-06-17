<template>
  <ul role="list" class="space-y-8" :class="{ 'pl-8': isNested }">
    <li v-for="comment in comments" :key="comment.id">
      <div class="flex space-x-3">
        <div>
          <div class="text-sm">
            <a href="#" class="font-medium text-gray-900">{{
              comment.user_name
            }}</a>
          </div>
          <div class="mt-1 text-sm text-gray-700">
            <p>{{ comment.content }}</p>
          </div>
          <div class="mt-2 text-sm space-x-2">
            <span class="text-gray-500 font-medium">{{
              comment.formatted_created_at
            }}</span>
            {{ " " }}
            <span class="text-gray-500 font-medium">&middot;</span>
            {{ " " }}
            <button
              @click="$emit('reply', comment)"
              type="button"
              class="text-gray-900 font-medium"
            >
              Reply
            </button>
          </div>
        </div>
      </div>
      <CommentsList
        @reply="replyToComment"
        class="mt-3 border-l-2 border-gray-300"
        :isNested="true"
        v-if="comment.comments"
        :comments="comment.comments"
      />
    </li>
  </ul>
</template>

<script setup>
const props = defineProps({
  comments: Array,
  isNested: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["reply"]);

const replyToComment = (comment) => {
  emit("reply", comment);
};
</script>