<div
    x-cloak
    x-show="isModalOpen"
    x-init="$watch('isModalOpen', isModalOpen => {
        const mainClasses = document.getElementById('main').classList
        if (isModalOpen) {
            mainClasses.add('overflow-y-hidden')
        } else {
            mainClasses.remove('overflow-y-hidden')
        }
    })"
    class="fixed z-50 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    @keydown.window.escape="isModalOpen = false"
>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 text-center sm:block sm:p-0">
        <div
            x-show="isModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            aria-hidden="true"
        ></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
        >&#8203;</span>

        <div
            x-show="isModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-full sm:w-2/3 lg:w-1/2"
            @click.away="$wire.closeModal()"
        >
            <div class="bg-white p-4 md:p-8 max-h-[85vh] overflow-y-auto">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
