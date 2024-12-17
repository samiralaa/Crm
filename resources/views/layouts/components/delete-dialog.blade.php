<!-- resources/views/components/delete-dialog.blade.php -->
<div x-data="{ showDialog: false, deleteId: @entangle('deleteId') }" x-show="showDialog" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold text-gray-800">Are you sure you want to delete this item?</h3>
        <p class="mt-2 text-gray-600">This action cannot be undone.</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button @click="showDialog = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancel</button>
            <form :action="route" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <input type="hidden" name="template_id" :value="deleteId">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>