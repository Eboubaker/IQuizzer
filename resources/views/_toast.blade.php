<div class="relative p-0 m-0">
    <div class="overflow-hidden absolute right-0 top-0 m-5 w-1/2 xl:w-1/5 lg:w-1/4 md:w-2/5 sm:w-1/2">
        <template x-for="notice of notices" :key="notice.id">
            <div
                    x-show="visible.includes(notice)"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform translate-x-full opacity-0"
                    @click="remove(notice.id)"
                    class="py-2 px-3 shadow-md mb-2 border-r-4 grid grid-cols-4"
                    :class="{
                    'bg-green-500 border-green-700': notice.type === 'success',
                    'bg-blue-400 border-blue-700': notice.type === 'info',
                    'bg-orange-400 border-orange-700': notice.type === 'warning',
                    'bg-red-500 border-red-700': notice.type === 'danger',
                    }"
                    style="pointer-events:all"
            >
                <div style="margin-top:4px" class="col-start-1 col-span-3">
                    <div class="text-white text-right">
                        <span x-text="notice.text"></span>
                    </div>
                </div>
                <div class="col-start-4 col-span-1 mx-1" x-html="getIcon(notice)"></div>
            </div>
        </template>
    </div>
</div>