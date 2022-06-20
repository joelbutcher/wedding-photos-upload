<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import Logo from '@/Components/Logo';
import Card from '@/Components/Card.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import TextArea from '@/Components/TextArea.vue';
import JetButton from '@/Jetstream/Button.vue';


const form = useForm({
  name: '',
  email: '',
  message: '',
  images: [],
});

const submit = () => {
  form.post(route('uploads.post'));
};
</script>

<template>
  <Head title="Welcome"/>

  <div class="relative flex items-top justify-center min-h-screen bg-slate-50 dark:bg-slate-800">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="flex flex-col items-center justify-center pt-8 sm:justify-start">
        <Logo>
          <template #intro>
            <p class="font-semibold text-sm tracking-widest text-slate-800 dark:text-white uppercase mb-6">
              Welcome to
            </p>
          </template>
        </Logo>
      </div>


      <div class="mt-8 border-t border-white">
        <div class="p-6">
          <p class="font-semibold text-sm tracking-wider text-slate-800 dark:text-white">
            {{ $page.props.application.names }} would love to invite you to share your experience of your day with them.
            If you have taken any photo's on your phone that you would like to share with the happy couple, you can do
            so below.
            You can also add an optional message with your upload(s), for {{ $page.props.application.names }} to enjoy
            with your images.
          </p>
        </div>
      </div>

      <div class="mt-8 flex flex-col sm:justify-center items-center">
        <Card>
          <form @submit.prevent="submit">
            <div>
              <Label for="name" value="Name(s)"/>
              <Input
                  id="name"
                  v-model="form.name"
                  type="email"
                  class="mt-1 block w-full"
                  required
                  autofocus
              />
            </div>

            <div class="mt-4">
              <Label for="email" value="Email"/>
              <Input
                  id="email"
                  v-model="form.email"
                  type="email"
                  class="mt-1 block w-full"
                  required
                  autofocus
              />
            </div>

            <div class="mt-4">
              <Label for="message" value="Message (optional)"/>
              <TextArea
                  id="message"
                  v-model="form.message"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autofocus
                  rows="5"
              />
            </div>

            <div class="mt-4">
              <input
                  ref="photoInput"
                  type="file"
                  class="text-slate-800 dark:text-white"
                  @change="updatePhotoPreview"
                  multiple
              >
            </div>

            <div class="flex items-center justify-end mt-4">
              <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
              </JetButton>
            </div>
          </form>
        </Card>
      </div>
    </div>
  </div>
</template>
