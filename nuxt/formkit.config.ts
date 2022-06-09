import { generateClasses } from '@formkit/themes'

const textTheme = {
  outer: 'mb-5',
  label: 'block mb-1 font-bold text-sm',
  inner: '',
  help: 'text-xs text-gray-500',
  input: 'p-3 rounded-md border bg-white border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black w-full',
  message: 'text-red-500 mb-1 text-xs'
}

const fileTheme = {
  outer: 'mb-5',
  label: 'block mb-1 font-bold text-sm',
  inner: 'border p-3 cursor-pointer border-primary-400 rounded-md focus-within:border-2 focus-within:shadow focus-within:shadow-primary-500',
  input: 'w-full',
  fileItem: 'w-full text-sm mt-2 text-gray-900 flex justify-between',
  removeFiles: 'text-sm text-red-400 p-1',
  fileList: '',
  // class="ab"
  noFiles: 'hidden',
  help: 'text-xs text-gray-500',
  message: 'text-red-500 mb-1 text-xs'
}

const selectTheme = {
  outer: 'mb-5',
  label: 'block mb-1 font-bold text-sm',
  help: 'text-xs text-gray-500',
  input: 'p-3 rounded-md border bg-white border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black w-full',
  messages: 'list-none p-0 mt-1 mb-0',
  message: 'text-red-500 mb-1 text-xs'
}

const submitTheme = {
  input: 'w-24 p-4 rounded-md bg-primary-500 focus:shadow-lg hover:shadow-lg ring-1 ring-primary-500 text-white',
  message: 'text-red-500 mb-1 text-xs',
}

export default {
  config: {
    classes: generateClasses({
      text: textTheme,
      file: fileTheme,
      textarea: textTheme,
      select: selectTheme,
      submit: submitTheme
    })
  }
}
