<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Solutions</h3>
        <button type="button" class="px-3 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700" data-solution-action="add">
            Add
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse(($other->solution ?? []) as $solution)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $solution->title }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $solution->description }}</td>
                        <td class="px-4 py-2 text-sm text-right whitespace-nowrap">
                            <button
                                type="button"
                                class="px-2 py-1 text-sm bg-gray-100 text-gray-800 rounded hover:bg-gray-200"
                                data-solution-action="edit"
                                data-solution-id="{{ $solution->id }}"
                                data-solution-title="{{ $solution->title }}"
                                data-solution-description="{{ $solution->description }}"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                class="ml-2 px-2 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700"
                                data-solution-action="delete"
                                data-solution-id="{{ $solution->id }}"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500" colspan="3">No solution rows found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="solutionModal" title="Solution" size="lg">
    <form id="solutionForm" class="space-y-4">
        @csrf
        <input type="hidden" id="solution_id" name="solution_id" value="">

        <div>
            <label for="solution_title" class="block text-sm font-medium text-gray-700 mb-2">Title*</label>
            <input type="text" id="solution_title" name="title" class="form-input w-full" required>
        </div>

        <div>
            <label for="solution_description" class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
            <textarea id="solution_description" name="description" rows="6" class="form-input w-full" required></textarea>
        </div>
    </form>

    <x-slot name="footer">
        <button type="button" onclick="closeModal('solutionModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Cancel</button>
        <button type="button" id="solutionSaveBtn" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
    </x-slot>
</x-modal>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    const solutionForm = document.getElementById('solutionForm');
    const solutionSaveBtn = document.getElementById('solutionSaveBtn');

    document.addEventListener('click', function (e) {
        if (!(e.target instanceof Element)) return;

        const solutionActionEl = e.target.closest('[data-solution-action]');
        if (!solutionActionEl) return;

        const action = solutionActionEl.getAttribute('data-solution-action');

        if (action === 'add') {
            document.getElementById('solution_id').value = '';
            document.getElementById('solution_title').value = '';
            document.getElementById('solution_description').value = '';
            openModal('solutionModal');
        }

        if (action === 'edit') {
            document.getElementById('solution_id').value = solutionActionEl.getAttribute('data-solution-id') || '';
            document.getElementById('solution_title').value = solutionActionEl.getAttribute('data-solution-title') || '';
            document.getElementById('solution_description').value = solutionActionEl.getAttribute('data-solution-description') || '';
            openModal('solutionModal');
        }

        if (action === 'delete') {
            const id = solutionActionEl.getAttribute('data-solution-id');
            if (!id) return;
            if (!confirm('Delete this solution?')) return;

            fetch(`{{ url('/admin/others/solution') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(async (res) => {
                    const data = await res.json().catch(() => null);
                    if (!res.ok) {
                        alert((data && data.message) ? data.message : 'Failed to delete solution');
                        return;
                    }
                    window.location.reload();
                })
                .catch(() => {
                    alert('Failed to delete solution');
                });
        }
    });

    if (solutionSaveBtn) {
        solutionSaveBtn.addEventListener('click', async function () {
            const id = document.getElementById('solution_id').value;
            const payload = {
                title: document.getElementById('solution_title').value,
                description: document.getElementById('solution_description').value,
            };

            let url = `{{ url('/admin/others/solution') }}`;
            let method = 'POST';
            if (id) {
                url = `{{ url('/admin/others/solution') }}/${id}`;
                method = 'PUT';
            }

            const res = await fetch(url, {
                method,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json().catch(() => null);

            if (!res.ok) {
                if (res.status === 422 && data && data.errors) {
                    const flattened = Object.values(data.errors).flat();
                    alert(flattened.join('\n'));
                    return;
                }

                alert((data && data.message) ? data.message : 'Failed to save solution');
                return;
            }

            closeModal('solutionModal');
            window.location.reload();
        });
    }
});
</script>