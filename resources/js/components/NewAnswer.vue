<template>
    <div class="flex flex-col my-4 mx-4">    
        <h2 class="text-lg font-bold text-gray-600">Your answer</h2>
        <form @submit.prevent="create">
            <div class="px-4 py-2 bg-white">
                <div class="mt-1">
                    <textarea id="body" v-model="body" :class="{'focus:ring-red-500 focus:border-red-500':error}" name="body" rows="7" maxlength="1000"
                        class="mt-1 block w-full shadow-sm sm:text-sm text-gray-600 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                        placeholder="You are going to post an answer for this question." required></textarea>
                </div>

                <div v-if="error" class="block ml-2">
                        <strong class="text-sm font-medium text-red-500">{{ error }}</strong>
                </div>
            </div>
            <div class="px-4 py-3 text-right sm:px-6">
                <button :disabled="isInvalid" type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:cursor-not-allowed">
                    Post answer
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'new-answer',
    props: ['id'],
    data() {
        return {
            body: '',
            error: null,
        }
    },
    computed: {
        isInvalid(){
            return (!this.signedIn || this.body.length < 10);
        },
        questionId(){
            return this.id;
        },
        endpoint(){
            return `/questions/${this.questionId}/answers`;
        },
    },
    methods: {
        create(){
            axios.post(this.endpoint, {
                body: this.body
            }).then(({data})=>{
                this.$toast.success(data.message, 'Success', {
                    position: 'topRight',
                    timeout: 3000
                });
                this.error = null
                this.body = ''
                this.$emit('created', data.answer);
            }).catch(err=>{
                this.$toast.error('Something went wrong. Please try again later.', 'Error', {
                    position: 'topRight',
                    timeout: 3000
                });
                if(err.response.data.errors.body){
                    this.error = err.response.data.errors.body[0];
                }
            })
        }
    },
}
</script>