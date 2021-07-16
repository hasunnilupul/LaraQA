<template>
  <div
    class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6"
    v-cloak
  >
    <h2 class="text-lg font-bold text-gray-600">
      {{ title }}
    </h2>
    <hr class="border-gray-300" />
    <div v-if="answers_count" class="answers-list">
      <answer
        v-for="(answer, index) in answers"
        :answer="answer"
        :key="answer.id"
        @deleted="deleteAnswer(index)"
      />
    </div>

    <div v-if="nextUrl" class="text-center my-3">
      <button
        @click="fetch(nextUrl)"
        type="button"
        class="
          px-2
          py-1
          border border-gray-500
          shadow-sm
          text-gray-600
          rounded
          text-sm
          font-semibold
          hover:bg-gray-500
          focus:bg-gray-500
          hover:text-gray-100
          focus:text-gray-100
          cursor-pointer
        "
      >
        Load More
      </button>
    </div>

    <new-answer :id="questionId" @added="addNewAnswer" />
  </div>
</template>

<script>
import Answer from "./Answer.vue";
import NewAnswer from "./NewAnswer.vue";

export default {
  name: "answers",
  props: ["question"],
  components: {
    Answer,
    NewAnswer,
  },
  data() {
    return {
      questionId: this.question.id,
      answers_count: this.question.answers_count,
      answers: [],
      nextUrl: null,
    };
  },
  created() {
    this.fetch(`/questions/${this.questionId}/answers`);
  },
  computed: {
    title() {
      return (
        this.answers_count +
        " " +
        (this.answers_count > 1 ? "Answers" : "Answer")
      );
    },
  },
  methods: {
    fetch(uri) {
      axios
        .get(uri)
        .then(({ data }) => {
          this.answers.push(...data.data);
          this.nextUrl = data.next_page_url;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteAnswer(index) {
      this.answers.splice(index, 1);
      this.answers_count--;
    },
    addNewAnswer(answer) {
      this.answers.push(answer);
      this.answers_count++;
    },
  },
};
</script>