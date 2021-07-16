<template>
  <div class="flex justify-start items-start mx-2 py-2 text-gray-600 border-b last:border-0 border-gray-300">
        <vote name="answer" :model="answer" iconsize="w-8 h-8"></vote>

        <div v-if="editing" class="flex flex-grow flex-col justify-center items-start ml-3">
            <form @submit.prevent="update" class="w-full">
                <div class="mt-1">
                    <textarea id="body" v-model="body" rows="7" maxlength="1000" required
                        class="mt-1 block w-full shadow-sm sm:text-sm text-gray-600 focus:ring-indigo-500 border-gray-300 focus:border-indigo-500 rounded-md"
                        placeholder="You are going to post an answer for this question."></textarea>
                </div>
                <div class="py-3 text-left">
                    <button type="submit" :disabled="isInvalid"
                        class="inline-flex justify-center py-1 px-2 mr-2 border border-indigo-600 shadow-sm text-sm font-semibold rounded text-white bg-indigo-600 focus:outline-none disabled:opacity-50">Update</button>
                    <button @click="cancel" type="button"
                        class="inline-flex justify-center py-1 px-2 border border-gray-600 shadow-sm text-sm font-semibold rounded text-gray-600 hover:text-white focus:text-white hover:bg-gray-600 focus:bg-gray-600 focus:outline-none">Cancel</button>

                </div>
            </form>
        </div>
        <div v-else class="flex flex-grow flex-col justify-center items-start ml-3">
            <div v-html="bodyHtml"></div>
            <div class="flex flex-auto w-full justify-between items-center mt-1">
                <div class="flex flex-auto">
                        <button v-if="authorize('modify', answer)" @click="edit" type="button"
                            class="px-2 py-1 mr-2 border border-blue-500 shadow-sm text-gray-600 rounded text-sm font-semibold hover:bg-blue-500 focus:bg-blue-500 hover:text-gray-100 focus:text-gray-100 cursor-pointer">
                            Edit
                        </button>
                        <button v-if="authorize('modify', answer)" @click="destroy" type="button"
                            class="px-2 py-1 border border-red-500 shadow-sm text-gray-600 rounded text-sm font-semibold hover:bg-red-500 focus:bg-red-500 hover:text-gray-100 focus:text-gray-100 cursor-pointer">
                            Delete
                        </button>
                </div>
                <div class="flex flex-col justify-end">
                    <user-info :model="answer" :label="'Answered'"/>
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
export default {
  name: "answer",
  props: ["answer"],
  data() {
    return {
      editing: false,
      body: this.answer.body,
      bodyHtml: this.answer.body_html,
      id: this.answer.id,
      questionId: this.answer.question_id,
      beforeEditCache: null,
    };
  },
  methods: {
    edit() {
      this.beforeEditCache = this.body;
      this.editing = true;
    },
    cancel() {
      this.body = this.beforeEditCache;
      this.editing = false;
    },
    update() {
      axios
        .patch(this.endpoint, {
          body: this.body,
        })
        .then((res) => {
          if (res.status == 200) {
            this.editing = false;
            this.bodyHtml = res.data.body_html;
            this.$toast.success(res.data.message, "Success", {
              position: "topRight",
              timeout: 3000,
            });
          }
        })
        .catch((err) => {
          this.$toast.success(err.response.data.message, "Error", {
            position: "topRight",
            timeout: 3000,
          });
        });
    },
    destroy() {
      this.$toast.question("Are you sure?", "Confirm", {
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        position: "center",
        buttons: [
          [
            "<button><b>YES</b></button>",
            (instance, toast) => {
              axios.delete(this.endpoint).then((res) => {
                $(this.$el).fadeOut(500, () => {
                  this.$toast.success(res.data.message, "Success", {
                    position: "topRight",
                    timeout: 3000,
                  });
                });
              });
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
            true,
          ],
          [
            "<button>NO</button>",
            (instance, toast) => {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
      });
    },
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    },
    endpoint() {
      return `/questions/${this.questionId}/answers/${this.id}`;
    },
  },
};
</script>