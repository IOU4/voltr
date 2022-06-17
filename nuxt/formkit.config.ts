import { generateClasses } from '@formkit/themes'

const textTheme = {
  outer: 'mb-5 formkit-disabled:opacity-60',
  label: 'block mb-1 font-bold text-sm',
  prefix: 'w-4 h-4',
  inner: '',
  help: 'text-xs text-gray-500',
  input: 'p-3 rounded-md border bg-white border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black w-full',
  message: 'text-red-500 mb-1 text-xs'
}

const fileTheme = {
  outer: 'mb-5 formkit-disabled:opacity-60',
  label: 'block mb-1 font-bold text-sm',
  inner: 'border p-3 cursor-pointer border-primary-400 rounded-md focus-within:border-2 focus-within:shadow focus-within:shadow-primary-500',
  input: 'text-gray-600 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-primary-500 file:text-white hover:file:bg-primary-700',
  fileItem: 'w-full text-sm mt-2 text-gray-900 flex justify-between',
  removeFiles: 'text-sm text-red-400 p-1',
  fileList: '',
  // class="ab"
  noFiles: 'hidden',
  help: 'text-xs text-gray-500',
  message: 'text-red-500 mb-1 text-xs'
}

const selectTheme = {
  outer: 'mb-5 formkit-disabled:opacity-60',
  label: 'block mb-1 font-bold text-sm',
  help: 'text-xs text-gray-500',
  input: 'p-3 rounded-md border bg-white border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black w-full',
  messages: 'list-none p-0 mt-1 mb-0',
  message: 'text-red-500 mb-1 text-xs'
}

const submitTheme = {
  outer: 'formkit-disabled:opacity-60',
  input: 'btn',
  message: 'text-red-500 mb-1 text-xs',
}

const dateTheme = {
  outer: 'mb-5 formkit-disabled:opacity-60',
  label: 'block mb-1 font-bold text-sm',
  inner: '',
  help: 'text-xs text-gray-500',
  input: 'p-3 rounded-md border bg-white border-primary-500 placeholder:text-xs palceholder:text-disabled focus:shadow-primary-500 focus:shadow text-black w-full',
  message: 'text-red-500 mb-1 text-xs'
}

const radioTheme = {
  outer: 'mb-5 formkit-disabled:opacity-60',
  label: 'text-sm',
  inner: '',
  help: 'text-xs text-gray-500',
  optionHelp: 'text-xs text-disabled',
  wrapper: 'flex items-center p-2 gap-2',
  message: 'text-red-500 mb-1 text-xs'
}

export default {
  config: {
    classes: generateClasses({
      text: textTheme,
      file: fileTheme,
      textarea: textTheme,
      select: selectTheme,
      submit: submitTheme,
      'datetime-local': dateTheme,
      button: submitTheme,
      email: textTheme,
      tel: textTheme,
      password: textTheme,
      radio: radioTheme,
    })
  }
}
