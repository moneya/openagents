<div class="flex flex-col w-full relative z-50 h-full">
    <div class="flex flex-col gap-2 mt-16 py-4 px-1" @thread_updated="$refresh">
        <ol>
            @foreach($threads as $thread)
                <livewire:sidebar-thread :thread="$thread" :key="$thread->id"/>
            @endforeach
        </ol>
    </div>

    <div class="flex flex-col gap-2 py-2 px-1 mt-auto">
        <ol>
            <li>
                <div class="relative z-[15]">
                    <div class="group relative rounded-lg active:opacity-90 px-3">
                        <a class="flex items-center gap-2 py-2"
                           wire:navigate
                           href="/blog"
                        >
                            <div class="select-none cursor-pointer relative grow overflow-hidden whitespace-nowrap">
                                Blog
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="relative z-[15]">
                    <div class="group relative rounded-lg active:opacity-90 px-3">
                        <a class="flex items-center gap-2 py-2"
                           wire:navigate
                           href="/changelog"
                        >
                            <div class="select-none cursor-pointer relative grow overflow-hidden whitespace-nowrap">
                                Changelog
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="relative z-[15]">
                    <div class="group relative rounded-lg active:opacity-90 px-3">
                        <a class="flex items-center gap-2 py-2"
                           wire:navigate
                           href="/docs"
                        >
                            <div class="select-none cursor-pointer relative grow overflow-hidden whitespace-nowrap">
                                Developer docs
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @pro
            <li>
                <div class="relative z-[15]">
                    <div class="group relative rounded-lg active:opacity-90 px-3">
                        <a href="/subscription" target="_blank" class="flex items-center gap-2 py-2">
                            <div class="relative grow overflow-hidden whitespace-nowrap">
                                Manage subscription
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @else
                @auth
                    <li>
                        <div class="relative z-[15]">
                            <div class="group relative rounded-lg active:opacity-90 px-3">
                                <a class="flex items-center gap-2 py-2"
                                   wire:click="$dispatch('openModal', { component: 'modals.upgrade' })"
                                >
                                    <div class="select-none cursor-pointer relative grow overflow-hidden whitespace-nowrap">
                                        Upgrade to Pro
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                @endauth
                @endpro
                <li>
                    <div class="relative z-[15]">
                        <div class="flex flex-row group pt-3 px-3 text-gray text-xs">
                            <a href="/terms" class="flex items-center">
                                <div class="relative grow overflow-hidden whitespace-nowrap">
                                    Terms
                                </div>
                            </a> <span class="px-1">&middot;</span>
                            <a href="/privacy" class="flex items-center">
                                <div class="relative grow overflow-hidden whitespace-nowrap">
                                    Privacy
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
        </ol>
    </div>
</div>
