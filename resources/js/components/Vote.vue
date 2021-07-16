<template>
  <div class="flex flex-col justify-center items-center py-1">
    <button @click="voteUp" :title="title('up')" type="button" :class="classes">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        class="bi bi-caret-up-fill"
        :class="iconsize"
        viewBox="0 0 16 16"
      >
        <path
          d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"
        />
      </svg>
    </button>

    <span class="block text-xl font-bold py-2">{{ count }}</span>

    <button
      @click="voteDown"
      :title="title('down')"
      type="button"
      :class="classes"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        class="bi bi-caret-down-fill"
        :class="iconsize"
        viewBox="0 0 16 16"
      >
        <path
          d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
        />
      </svg>
    </button>

    <Favourite v-if="name == 'question'" :question="model" />
    <AcceptAnswer v-if="name == 'answer'" :answer="model" />
  </div>
</template>

<script>
import Favourite from "./Favourite.vue";
import AcceptAnswer from "./AcceptAnswer.vue";

export default {
  name: "vote",
  props: ["name", "model", "iconsize"],
  components: {
    Favourite,
    AcceptAnswer,
  },
  data() {
    return {
      count: this.model.votes_count || 0,
      id: this.model.id,
    };
  },
  methods: {
    title(voteType) {
      let titles = {
        up: `This ${this.name} is useful`,
        down: `This ${this.name} is not useful`,
      };
      return titles[voteType];
    },
    voteUp() {
      this._vote(1);
    },
    voteDown() {
      this._vote(-1);
    },
    _vote(vote) {
      if (!this.signedIn) {
        this.$toast.warning(
          `Please sign in to vote the ${this.name}`,
          "Warning",
          { position: "topRight", timeout: 3000 }
        );
        return;
      }
      axios
        .post(this.endpoint, {
          vote: vote,
        })
        .then((res) => {
          this.$toast.success(res.data.message, "Success", {
            position: "topRight",
            timeout: 3000,
          });

          this.count = res.data.votesCount;
        });
    },
  },
  computed: {
    classes() {
      return ["block", !this.signedIn ? "off" : ""];
    },
    endpoint() {
      return `/${this.name}s/${this.id}/vote`;
    },
  },
};
</script>