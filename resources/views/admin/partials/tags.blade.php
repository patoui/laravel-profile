<div id="tag_container" class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">Tags</label>
    <div class="flex items-center border-b border-b-2 border-blue-400 py-2">
        <input id="new_tag" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Tag name..." aria-label="Tag name" v-model="name">
        <button id="add_tag" class="flex-shrink-0 bg-blue-400 hover:bg-blue-600 border-blue-400 hover:border-blue-600 text-sm border-4 text-white px-2 rounded outline-none" type="button" @click="add">Add</button>
    </div>

    <div id="tags" class="mt-4">
        {{-- <span class="mr-2 bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' + tag }}</span> --}}
    </div>

    <div id="hidden_tags">
        {{-- <input type="hidden" name="tags[]"> --}}
    </div>

    <p id="tags_error" style="display: none" class="text-red-500 text-xs italic"></p>
</div>

@push('scripts')
<script>
(function() {
    const elNewTag = document.querySelector('#new_tag');
    const elAddTag = document.querySelector('#add_tag');

    const elTags = document.querySelector('#tags');
    const elHiddenTags = document.querySelector('#hidden_tags');

    elAddTag.addEventListener('click', function (e) {
        addTag(elNewTag.value);
        elNewTag.value = '';
    });

    function addTag(tag) {
        const newTag = document.createElement('span');
        newTag.setAttribute('class', 'mr-2 bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline');
        newTag.innerHTML = `#${tag}`;
        elTags.append(newTag);

        const newHiddenTag = document.createElement('input');
        newHiddenTag.setAttribute('type', 'hidden');
        newHiddenTag.setAttribute('name', 'tags[]');
        newHiddenTag.setAttribute('value', tag);
        elHiddenTags.append(newHiddenTag);
    }

    const existingTags = @json($tags ?? []);

    if (existingTags && Array.isArray(existingTags) && existingTags.length > 0) {
        existingTags.forEach(tag => {
            addTag(tag);
        });
    }
})();
</script>
@endpush