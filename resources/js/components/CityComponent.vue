<template>
    <div class="flex-1">
        <label>Ville</label>
        <div class="pb-4">
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" :name="inputName" placeholder="Votre ville" :value="cityName" required>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cityName: {
                required: true,
                type: String
            },
            inputName: {
                required: true,
                type: String
            }
        },
        data() {
            return {
            }
        }
    }
</script>
