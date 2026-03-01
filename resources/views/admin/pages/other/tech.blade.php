 <div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Tech</h3>
        <button type="button" class="px-3 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700" data-tech-action="add">
            Add
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse(($other->tech ?? []) as $tech)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $tech->title }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $tech->url }}</td>
                        <td class="px-4 py-2 text-sm text-right whitespace-nowrap">
                            <button
                                type="button"
                                class="px-2 py-1 text-sm bg-gray-100 text-gray-800 rounded hover:bg-gray-200"
                                data-tech-action="edit"
                                data-tech-id="{{ $tech->id }}"
                                data-tech-title="{{ $tech->title }}"
                                data-tech-url="{{ $tech->url }}"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                class="ml-2 px-2 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700"
                                data-tech-action="delete"
                                data-tech-id="{{ $tech->id }}"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500" colspan="3">No tech rows found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="techModal" title="Tech" size="md">
    <form id="techForm" class="space-y-4">
        @csrf
        <input type="hidden" id="tech_id" name="tech_id" value="">

        <div>
            <label for="tech_title" class="block text-sm font-medium text-gray-700 mb-2">Title*</label>
            <input type="text" id="tech_title" name="title" class="form-input w-full" required>
        </div>

        <div>
            <label for="tech_url" class="block text-sm font-medium text-gray-700 mb-2">URL*</label>
            <input type="text" id="tech_url" name="url" class="form-input w-full" required>
        </div>
    </form>

    <x-slot name="footer">
        <button type="button" onclick="closeModal('techModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Cancel</button>
        <button type="button" id="techSaveBtn" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
    </x-slot>
</x-modal>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    const techForm = document.getElementById('techForm');
    const techSaveBtn = document.getElementById('techSaveBtn');
    const techIdInput = document.getElementById('tech_id');
    const techTitleInput = document.getElementById('tech_title');
    const techUrlInput = document.getElementById('tech_url');

    document.addEventListener('click', function (e) {
        if (!(e.target instanceof Element)) return;

        const techActionEl = e.target.closest('[data-tech-action]');
        if (!techActionEl) return;

        const action = techActionEl.getAttribute('data-tech-action');

        if (action === 'add') {
            techIdInput.value = '';
            techTitleInput.value = '';
            techUrlInput.value = '';
            openModal('techModal');
        }

        if (action === 'edit') {
            techIdInput.value = techActionEl.getAttribute('data-tech-id') || '';
            techTitleInput.value = techActionEl.getAttribute('data-tech-title') || '';
            techUrlInput.value = techActionEl.getAttribute('data-tech-url') || '';
            openModal('techModal');
        }

        if (action === 'delete') {
            const id = techActionEl.getAttribute('data-tech-id');
            if (!id) return;
            if (!confirm('Delete this tech?')) return;

            fetch(`{{ url('/admin/others/tech') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(async (res) => {
                    const data = await res.json().catch(() => null);
                    if (!res.ok) {
                        alert((data && data.message) ? data.message : 'Failed to delete tech');
                        return;
                    }
                    window.location.reload();
                })
                .catch(() => {
                    alert('Failed to delete tech');
                });
        }
    });

    if (techSaveBtn) {
        techSaveBtn.addEventListener('click', async function () {
            const id = techIdInput.value;
            const payload = {
                title: techTitleInput.value,
                url: techUrlInput.value,
            };

            let url = `{{ url('/admin/others/tech') }}`;
            let method = 'POST';
            if (id) {
                url = `{{ url('/admin/others/tech') }}/${id}`;
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

                alert((data && data.message) ? data.message : 'Failed to save tech');
                return;
            }

            closeModal('techModal');
            window.location.reload();
        });
    }
});
</script>