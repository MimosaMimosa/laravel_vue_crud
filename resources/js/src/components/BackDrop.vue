<template>
    <div class="back-drop">
        <slot/>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
.back-drop {
    width: 100%;
    position: fixed;
    min-height: 100vh;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .2s ease;
    display: flex;
    justify-content: center;
    // align-items: center;
}
</style>
