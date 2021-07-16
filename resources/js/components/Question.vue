<template>
  <div v-cloak class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
    <form
      v-if="editing"
      @submit.prevent="update"
      class="
        flex flex-col
        justify-center
        items-start
        p-4
        border border-gray-200
        text-gray-600
      "
    >
      <div class="mt-1 w-full">
        <label for="title" class="block text-sm font-medium text-gray-700"
          >Title</label
        >
        <input
          v-model="title"
          type="text"
          name="title"
          id="title"
          autocomplete="title"
          required
          class="
            mt-1
            block
            w-full
            shadow-sm
            sm:text-sm
            text-gray-600
            focus:ring-indigo-500
            border-gray-300
            focus:border-indigo-500
            rounded-md
          "
        />
        <label for="body" class="mt-2 block text-sm font-medium text-gray-700">
          Brief description
          <span
            class="text-xs font-normal sm:ml-auto"
            :class="{
              'text-blue-700': question - body.length < 1000,
              'text-red-500': question - body.length >= 1000,
            }"
          >
            {{ question.body.length + "/1000" }}
          </span>
        </label>
        <textarea
          id="body"
          v-model="body"
          rows="10"
          maxlength="1000"
          required
          class="
            mt-1
            block
            w-full
            shadow-sm
            sm:text-sm
            text-gray-600
            focus:ring-indigo-500
            border-gray-300
            focus:border-indigo-500
            rounded-md
          "
          placeholder="You are going to post an answer for this question."
        ></textarea>
      </div>
      <div class="flex flex-auto w-full justify-start items-center mt-2">
        <button
          type="submit"
          :disabled="isInvalid"
          class="
            inline-flex
            justify-center
            py-1
            px-2
            mr-2
            border border-indigo-600
            shadow-sm
            text-sm
            font-semibold
            rounded
            text-white
            bg-indigo-600
            focus:outline-none
            disabled:opacity-50
          "
        >
          Update
        </button>
        <button
          @click="cancel"
          type="button"
          class="
            inline-flex
            justify-center
            py-1
            px-2
            border border-gray-600
            shadow-sm
            text-sm
            font-semibold
            rounded
            text-gray-600
            hover:text-white
            focus:text-white
            hover:bg-gray-600
            focus:bg-gray-600
            focus:outline-none
          "
        >
          Cancel
        </button>
      </div>
    </form>

    <div
      v-else
      class="
        flex
        justify-start
        items-start
        p-4
        border border-gray-200
        text-gray-600
      "
    >
      <vote name="question" :model="question" iconsize="w-10 h-10"></vote>

      <div class="flex flex-grow flex-col items-start justify-center pl-3">
        <div v-html="bodyHtml"></div>

        <div class="flex flex-auto w-full justify-between items-center mt-2">
          <div class="flex flex-auto">
            <button
              v-if="authorize('modify', question)"
              @click="edit"
              type="button"
              class="
                px-2
                py-1
                mr-2
                border border-blue-500
                shadow-sm
                text-gray-600
                rounded
                text-sm
                font-semibold
                hover:bg-blue-500
                focus:bg-blue-500
                hover:text-gray-100
                focus:text-gray-100
                cursor-pointer
              "
            >
              Edit
            </button>
            <button
              v-if="authorize('deleteQuestion', question)"
              @click="destroy"
              type="button"
              class="
                px-2
                py-1
                border border-red-500
                shadow-sm
                text-gray-600
                rounded
                text-sm
                font-semibold
                hover:bg-red-500
                focus:bg-red-500
                hover:text-gray-100
                focus:text-gray-100
                cursor-pointer
              "
            >
              Delete
            </button>
          </div>

          <user-info :model="question" :label="'Asked'"></user-info>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserInfo from "./UserInfo.vue";
import modification from "../mixins/modification";

export default {
  name: "question",
  props: ["question"],
  mixins: [modification],
  components: {
    UserInfo,
  },
  data() {
    return {
      title: this.question.title,
      body: this.question.body,
      bodyHtml: this.question.body_html,
      id: this.question.id,
      beforeEditCache: {},
    };
  },
  computed: {
    isInvalid() {
      return this.body.length < 10 || this.title.length < 10;
    },
    endpoint() {
      return `/questions/${this.id}`;
    },
  },
  methods: {
    setEditCache() {
      this.beforeEditCache = {
        title: this.title,
        body: this.body,
      };
    },
    restoreFromCache() {
      this.title = this.beforeEditCache.title;
      this.body = this.beforeEditCache.body;
    },
    payload() {
      return {
        title: this.title,
        body: this.body,
      };
    },
    delete() {
      axios.delete(this.endpoint).then(({ data }) => {
        this.$toast.success(data.message, "Success", {
          position: "topRight",
          timeout: 2000,
        });
      });

      setTimeout(() => {
        window.location.href = "/questions";
      }, 3000);
    },
  },
};
</script>