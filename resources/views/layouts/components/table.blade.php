@props([
    'headers' => [],
    'body' => [],
    'emptyMessage' => 'No data available.',
    'striped' => false,
    'hover' => true,
    'bordered' => true,
])

<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        @if (!empty($headers))
            <thead class="bg-gray-50">
                <tr>
                    @foreach ($headers as $header)
                        <th scope="col" class="{{ $header['class'] ?? 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider' }}">
                            {{ $header['title'] }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        
        <tbody class="{{ $striped ? 'divide-y divide-gray-200' : '' }} {{ $hover ? 'divide-y divide-gray-200' : '' }} bg-white">
            @if (count($body) > 0)
                @foreach ($body as $index => $row)
                    <tr class="{{ $striped && $index % 2 === 1 ? 'bg-gray-50' : '' }} {{ $hover ? 'hover:bg-gray-50' : '' }}">
                        @foreach ($headers as $key => $header)
                            <td class="{{ $header['cellClass'] ?? 'px-6 py-4 whitespace-nowrap text-sm text-gray-900' }}">
                                {{ isset($row[$key]) ? $row[$key] : $row }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-6 py-12 text-center text-sm text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $emptyMessage }}</h3>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
