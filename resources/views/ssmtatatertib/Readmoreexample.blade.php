<td style="width: 33%; text-align: justify">
    <div class="text-container catatan" data-record-id="{{ $ssmpermohonansalinan->id }}">
        @if (strlen($ssmpermohonansalinan->permohonan_catatan) > 100)
            <div class="limited-text">
                {{ Str::limit($ssmpermohonansalinan->permohonan_catatan, 100) }}
            </div>
            <div class="full-text" style="display: none;">
                {{ $ssmpermohonansalinan->permohonan_catatan }}
            </div>
            <a href="#" class="read-more" style="color: rgb(42, 152, 156);">Read More</a>
        @else
            <div class="full-text">
                {{ $ssmpermohonansalinan->permohonan_catatan }}
            </div>
        @endif
    </div>
</td>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add a click event listener to a common ancestor of "Read More" links
        document.querySelector('.catatan[data-record-id="{{ $ssmpermohonansalinan->id }}"]').addEventListener('click', function (event) {
            // Check if the clicked element is a "Read More" link
            if (event.target.classList.contains('read-more')) {
                event.preventDefault();

                // Find the parent container
                const container = event.target.closest('.text-container');

                // Toggle the display of the limited and full text based on data attribute
                const limitedText = container.querySelector('.limited-text');
                const fullText = container.querySelector('.full-text');

                limitedText.style.display = limitedText.style.display === 'none' ? 'block' : 'none';
                fullText.style.display = fullText.style.display === 'none' ? 'block' : 'none';

                // Change the text and color of the link based on the current state
                if (event.target.textContent === 'Read More') {
                    event.target.textContent = 'Read Less';
                    event.target.style.color = 'grey';
                } else {
                    event.target.textContent = 'Read More';
                    event.target.style.color = 'rgb(42, 152, 156)';
                }
            }
        });
    });
</script>