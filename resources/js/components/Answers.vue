<template>
  <div
    class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-4 mt-6"
    v-cloak
  >
    <h2 class="text-lg font-bold text-gray-600">
      {{ title }}
    </h2>
    <hr class="border-gray-300" />
    <div v-if="count" class="answers-list">
      <answer v-for="answer in answers" :answer="answer" :key="answer.id" />
    </div>

    <!-- @include('answers._create')-->
  </div>
</template>

<script>
import Answer from "./Answer.vue";

export default {
  name: "answers",
  props: ["answers", "count"],
  components: {
    Answer,
  },
  computed: {
    title() {
      return this.count + " " + (this.count > 1 ? "Answers" : "Answer");
    },
  },
};
</script>