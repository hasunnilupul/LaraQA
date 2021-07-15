<template>
  <div>
    <button
      v-if="canAccept"
      @click="create"
      type="button"
      title="Mark this answer as best answer"
      :class="classes"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        class="bi bi-check-lg h-5 w-5"
        viewBox="0 0 16 16"
      >
        <path
          d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"
        />
      </svg>
    </button>

    <button
      v-if="accepted"
      type="button"
      title="Marked as the best answer by answer owner"
      :class="classes"
      onclick="event.preventDefault();"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        class="bi bi-check-lg h-5 w-5"
        viewBox="0 0 16 16"
      >
        <path
          d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"
        />
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  name: "accept-answer",
  props: ["answer"],
  data() {
    return {
      isBest: this.answer.is_best,
      id: this.answer.id,
    };
  },
  methods: {
    create() {
      axios.post(`/answers/${this.id}/accept`).then((res) => {
        this.$toast.success(res.data.message, "Success", {
          position: "topRight",
          timeout: 3000,
        });
        this.isBest = true;
      });
    },
  },
  computed: {
    canAccept() {
      return this.authorize('accept', this.answer);
    },
    accepted() {
      return !this.canAccept && this.isBest;
    },
    classes() {
      return [
        "block mt-2 text-center",
        this.isBest ? "accepted" : "not-accepted",
      ];
    },
  },
};
</script>