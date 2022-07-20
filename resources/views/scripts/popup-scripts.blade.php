<script>
    $(document).ready(function() {
        let i = "{!! $i ?? 0 !!}" ||  0;
        $(document).on('click', '#addRule', function ()  {
            i++;
            let html = `
            <div class="ruleRow mx-4 my-6 grid w-full grid-cols-7 bg-gray-100" id="row${i}">
                <div class="col-span-1 pr-4">
                    <select id="status" name=form[${i}][status] class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
                        <option value="1">Show on</option>
                        <option value="0">Don't Show on</option>
                    </select>
                </div>
                <div class="col-span-1 pr-4">
                    <select id="rules" name="form[${i}][rule]" class="block w-full border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:text-blue-400 focus:ring-blue-500">
                        <option disabled selected>Select Rule</option>
                            @foreach($rules as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-span-3">
                    <div>
                        <div class="flex">
                            <label for="pages" class="mt-2 w-4/12 pr-3 text-right text-base font-medium text-gray-900">www.{{ $domain->top_level }}/</label>
                            <input type="text" name="form[${i}][page]" class="block w-6/12 border border-gray-300 bg-gray-50 p-2.5 text-left text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="" />
                            <button id="${i}" onclick="event.preventDefault()" class="removeRow py-2.0 ml-2 w-full rounded-lg bg-red-700 px-4 text-center text-sm font-medium text-white sm:w-auto">X</button>
                        </div>
                    </div>
                </div>
            </div>
            `
            $('#appendNewRows').append(html);
        });

        // Remove
        $(document).on('click', '.removeRow', function () {
            let buttonId = $(this).attr('id');
            $(`#row${buttonId}`).remove()
        });
    })
</script>