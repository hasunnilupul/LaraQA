<template>
    <div>
        <div class="text-sm font-medium text-gray-400">{{ postDate }}</div>
        <div class="flex justify-end mt-2">
            <a :href="user.url" class="pr-2 select-none">
                <img :src="user.avatar" alt="user-img" class="rounded-full w-8 h-8">
            </a>
            <a :href="user.url" class="text-sm font-bold text-blue-600 mt-2">
                {{ user.name }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props:['model', 'label'],
    computed: {
        postDate(){
            return this.label+" "+this.model.created_date;
        },
    },
    data() {
        return {
            user: this.model.user,
            
        }
    },
}
</script>