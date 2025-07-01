@extends('layouts.admin')

@section('admin-content')
<div class="card">
    <div class="card-header">
        <h5>Add Legal Documents (Alternative Process)</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
          <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <h5>XML File Requirements:</h5>
                    <ul>
                        <li>File must have a <code>.xml</code> extension</li>
                        <li>XML must be well-formed and valid</li>
                        <li>XML should not contain external entity references</li>
                        <li>Make sure the XML has a <code>&lt;Body&gt;</code> element</li>
                        <li>Maximum file size: 10MB</li>
                    </ul>
                </div>
                
                <div class="form-container">
                    <form action="{{ route('admin.legal-documents.process-alternative') }}" method="post" enctype="multipart/form-data">
                        @csrf                        <div class="mb-3">
                            <label for="xmlfile" class="form-label">XML File:</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('xmlfile') is-invalid @enderror" id="xmlfile" name="xmlfile" accept=".xml" required>                                @error('xmlfile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Only XML files are accepted (.xml extension). Make sure the XML file is well-formed and doesn't contain external entity references.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="law_id" class="form-label">Law ID:</label>
                            <input type="number" class="form-control @error('law_id') is-invalid @enderror" id="law_id" name="law_id" value="{{ old('law_id', 1) }}" required>
                            @error('law_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="act_id" class="form-label">Act ID:</label>
                            <input type="number" class="form-control @error('act_id') is-invalid @enderror" id="act_id" name="act_id" value="{{ old('act_id', 1) }}" required>
                            @error('act_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="act_name" class="form-label">Act Name:</label>
                            <input type="text" class="form-control @error('act_name') is-invalid @enderror" id="act_name" name="act_name" value="{{ old('act_name') }}" required>
                            @error('act_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurisdiction_id" class="form-label">Jurisdiction ID:</label>
                            <input type="number" class="form-control @error('jurisdiction_id') is-invalid @enderror" id="jurisdiction_id" name="jurisdiction_id" value="{{ old('jurisdiction_id', 1) }}" required>
                            @error('jurisdiction_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="language" class="form-label">Language:</label>
                            <select class="form-control @error('language') is-invalid @enderror" id="language" name="language" required>
                                <option value="">Select Language</option>
                                <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>English</option>
                                <option value="French" {{ old('language') == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Both" {{ old('language') == 'Both' ? 'selected' : '' }}>Both (English & French)</option>
                            </select>
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                          <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload XML</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('xmlfile');
    const form = fileInput.closest('form');
    
    form.addEventListener('submit', function(e) {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();
            
            if (fileExtension !== 'xml') {
                e.preventDefault();
                alert('Please select a valid XML file with .xml extension');
                return false;
            }
        }
    });
    
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            const file = this.files[0];
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();
            
            if (fileExtension !== 'xml') {
                alert('Please select a valid XML file with .xml extension');
                this.value = ''; // Clear the file input
            }
        }
    });
});
</script>
@endpush
        
        <!-- Display existing tables -->
        <div class="table-container mt-4">
            <h5>Uploaded Documents</h5>
            
            @if(isset($tables) && count($tables) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Table Name</th>
                                <th>Original Filename</th>
                                <th>Act Name</th>
                                <th>Law ID</th>
                                <th>Act ID</th>
                                <th>Jurisdiction</th>
                                <th>Language</th>
                                <th>Upload Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                                <tr>
                                    <td>{{ $table->id }}</td>
                                    <td>{{ $table->table_name }}</td>
                                    <td>{{ $table->original_filename }}</td>
                                    <td>{{ $table->act_name }}</td>
                                    <td>{{ $table->law_id }}</td>
                                    <td>{{ $table->act_id }}</td>
                                    <td>{{ $table->jurisdiction_id }}</td>
                                    <td>{{ $table->language }}</td>
                                    <td>{{ $table->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">No documents have been uploaded yet.</div>
            @endif
        </div>
    </div>
</div>
@endsection
