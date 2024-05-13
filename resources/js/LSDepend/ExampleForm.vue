<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 bg-white sm:p-6">
      <div class="">
        <div class="">
          <label
            for="company-website"
            class="block text-sm font-medium text-gray-700"
          >
            Enlace
          </label>
          <div class="mt-1 rounded-md">
            <span
              class="
                inline-flex
                items-center
                px-3
                rounded-l-md
                border border-r-0 border-gray-300
                bg-gray-50
                text-gray-500 text-sm
              "
            >
              http://
            </span>
            <input
              type="text"
              name="company-website"
              id="company-website"
              class="
                focus:ring-indigo-500 focus:border-indigo-500
                flex-1
                block
                w-full
                rounded-none rounded-r-md
                sm:text-sm
                border-gray-300
              "
              placeholder="www.example.com"
            />
          </div>
        </div>
      </div>

      <div>
        <label for="about" class="block text-sm font-medium text-gray-700">
          Informacion
        </label>
        <div class="mt-1">
          <textarea
            id="about"
            name="about"
            rows="3"
            class="
              shadow-sm
              focus:ring-indigo-500 focus:border-indigo-500
              mt-1
              block
              w-full
              sm:text-sm
              border border-gray-300
              rounded-md
            "
            placeholder="you@example.com"
          />
        </div>
        <p class="mt-2 text-sm text-gray-500">Describa la info.</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700"> Photo </label>
        <div class="mt-1 flex items-center">
          <span
            class="
              inline-block
              h-12
              w-12
              rounded-full
              overflow-hidden
              bg-gray-100
            "
          >
            <svg
              class="h-full w-full text-gray-300"
              fill="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
              />
            </svg>
          </span>
          <button
            type="button"
            class="
              ml-5
              bg-white
              py-2
              px-3
              border border-gray-300
              rounded-md
              shadow-sm
              text-sm
              leading-4
              font-medium
              text-gray-700
              hover:bg-gray-50
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-indigo-500
            "
          >
            Change
          </button>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">
          Cover photo
        </label>
        <div
          class="
            mt-1
            flex
            justify-center
            px-6
            pt-5
            pb-6
            border-2 border-gray-300 border-dashed
            rounded-md
          "
        >
          <div class="space-y-1 text-center">
            <svg
              class="mx-auto h-12 w-12 text-gray-400"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 48 48"
              aria-hidden="true"
            >
              <path
                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <div class="flex text-sm text-gray-600">
              <label
                for="file-upload"
                class="
                  relative
                  cursor-pointer
                  bg-white
                  rounded-md
                  font-medium
                  text-indigo-600
                  hover:text-indigo-500
                  focus-within:outline-none
                  focus-within:ring-2
                  focus-within:ring-offset-2
                  focus-within:ring-indigo-500
                "
              >
                <span>Upload a file</span>
                <input
                  id="file-upload"
                  name="file-upload"
                  type="file"
                  class="sr-only"
                />
              </label>
              <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
          </div>
        </div>
      </div>
    </div>
    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
      <button
        type="submit"
        class="
          inline-flex
          justify-center
          py-2
          px-4
          border border-transparent
          shadow-sm
          text-sm
          font-medium
          rounded-md
          text-white
          bg-indigo-600
          hover:bg-indigo-700
          focus:outline-none
          focus:ring-2
          focus:ring-offset-2
          focus:ring-indigo-500
        "
      >
        Save
      </button>
    </div>
  </div>

  <div class="w-full bg-white rounded-lg shadow-lg lg:w-1/3">
    <ul class="divide-y-2 divide-gray-400">
      <li
        class="flex justify-between p-3 hover:bg-blue-600 hover:text-blue-200"
      >
        View List Item
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 8l4 4m0 0l-4 4m4-4H3"
          />
        </svg>
      </li>
      <li
        class="flex justify-between p-3 hover:bg-blue-600 hover:text-blue-200"
      >
        Edit List Item
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6 text-blue-600"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
          />
        </svg>
      </li>
      <li
        class="
          flex
          items-center
          justify-between
          p-3
          hover:bg-blue-600 hover:text-blue-200
        "
      >
        Messages
        <span class="px-2 py-1 text-sm text-blue-200 bg-blue-600 rounded-full"
          >+1</span
        >
      </li>
    </ul>
  </div>
</template>

