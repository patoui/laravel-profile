<template>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" v-bind:class="{ 'border-red-500': errors.has('tags') }" for="tags">Tags</label>
    <div class="flex items-center border-b border-b-2 border-blue-400 py-2">
        <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Tag name..." aria-label="Tag name" v-model="name">
        <button class="flex-shrink-0 bg-blue-400 hover:bg-blue-600 border-blue-400 hover:border-blue-600 text-sm border-4 text-white px-2 rounded outline-none" type="button" @click="add">Add</button>
    </div>

    <div class="mt-4">
        <span class="mr-2 bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline" v-for="tag in tags">{{ '#' + tag }}</span>
    </div>

    <input type="hidden" name="tags[]" v-for="tag in tags" v-bind:value="tag">

    <p v-if="errors.has('tags')" class="text-red-500 text-xs italic">{{ errors.first('tags') }}</p>
</div>
</template>

<script>
    import Errors from '../classes/Errors';

    export default {
        props: ['initialTags', 'initialErrors'],

        data() {
            return {
                errors: new Errors(),
                name: '',
                tags: []
            };
        },

        mounted() {
            this.tags = this.initialTags;
            this.errors = new Errors(this.initialErrors);
        },

        methods: {
            add() {
                this.tags.push(this.name);
                this.name = '';
            }
        }
    }
</script>
