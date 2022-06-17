<template>
  <div class="bg-gray-50 px-4 py-6 sm:px-6">
    <div class="flex space-x-3">
      <div class="min-w-0 flex-1">
        <form @submit.prevent="submit" class="space-y-3">
          <div
            @click="$emit('clearReply')"
            v-if="props.commentToReply"
            class="group cursor-pointer hover:text-red-500"
          >
            <p>Replying to {{ props.commentToReply.user_name }}:</p>
            <div class="flex spce-x-1 items-center">
              <div class="prose">
                <blockquote class="group-hover:text-red-500">
                  <p>
                    {{ props.commentToReply.content }}
                  </p>
                </blockquote>
              </div>
              <XIcon class="text-red-500 h-4 w-5 ml-1" />
            </div>
          </div>
          <div class="rounded-md">
            <input
              v-model="form.user_name"
              type="text"
              :class="
                form.errors.user_name
                  ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                  : 'focus:ring-blue-500 focus:border-blue-500'
              "
              class="block w-full sm:text-sm border-gray-300 rounded-md"
              placeholder="Your name"
            />
          </div>
          <div>
            <textarea
              v-model="form.comment"
              :class="
                form.errors.comment
                  ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                  : 'focus:ring-blue-500 focus:border-blue-500'
              "
              rows="3"
              class="block w-full sm:text-sm border-gray-300 rounded-md"
              placeholder="Comment"
            />
          </div>
          <div class="flex items-center justify-between">
            <button
              type="submit"
              class="
                inline-flex
                items-center
                justify-center
                px-4
                py-2
                border border-transparent
                text-sm
                font-medium
                rounded-md
                shadow-sm
                text-white
                bg-blue-600
                hover:bg-blue-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-blue-500
              "
            >
              Comment
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { XIcon } from "@heroicons/vue/solid";

const props = defineProps({
  commentToReply: Object,
});

const emit = defineEmits(["clearReply"]);

const form = useForm({
  user_name: "",
  comment: "",
});

const submit = () => {
  const routeName = props.commentToReply
    ? "comments.comments.store"
    : "comments.store";

  form.post(
    route(routeName, props.commentToReply ? props.commentToReply.id : {}),
    {
      preserveScroll: true,
    }
  );
};
</script>