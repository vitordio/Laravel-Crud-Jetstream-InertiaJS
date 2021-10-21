<template>
    <section class="flex flex-col md:flex-row h-screen items-center">
        <slot name="background" />

        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
            <div class="w-full h-100">
                <slot name="logo" />
                <slot name="pageTitle" />
                <slot />
            </div>
        </div>
    </section>
</template>
