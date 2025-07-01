# DUAL WORKFLOW IMPLEMENTATION

## Overview
JurisLocator now supports two distinct session-based workflows:

1. **User-Centric Session-Based Workflow** (Default Personal Session)
2. **Client-Centric Session-Based Workflow** (Client Selection Mode)

## Workflow Description

### Login Flow
When users log in, they are **automatically redirected to the User-Centric Home Page**. Users can optionally switch to Client-Based mode using the sidebar navigation.

### 1. User-Centric Session-Based Workflow (Default Personal Session)

**Entry Point:** Direct login redirect to user-centric home page.

**Characteristics:**
- **Default workflow** for all users after login
- Direct access to legal documents without client association
- Personal notes and annotations saved to user account only
- Personal templates and document management
- User-specific popups and text data
- All data stored with `client_id = null` in the database

**Navigation Flow:**
```
Login → User Home (Default) → Legal Research Tools
```

**Key Pages:**
- `/user-home` - Main dashboard with tiles for different features
- `/user-legal-tables` - Legal document search and browsing
- `/user-notes` - Personal notes and annotations management
- `/user-templates` - Personal template management
- `/user-immigration-programs` - Immigration program information
- `/user-support` - Support and help center

**Sidebar Navigation:**
- **Home** - User-centric dashboard
- **Legal Documents** - Browse legal documents
- **My Notes** - Personal notes management
- **My Templates** - Personal templates
- **Government Links** - Resources and links
- **Switch to Client Mode** - Change to client-centric workflow

**Features:**
1. **Legislation** - Browse Acts, Regulations, Legal Statutes
2. **CaseLaw** - Search Court Decisions and Legal Precedents
3. **My Notes & Annotations** - Personal research notes
4. **Immigration Programs** - Program information and guides
5. **Resources** - Government links, templates, legal tools
6. **Support** - Help center and contact support

### 2. Client-Centric Session-Based Workflow (Client Selection Mode)

**Entry Point:** User clicks "Switch to Client Mode" in the sidebar navigation.

**Characteristics:**
- Requires client selection before accessing legal documents
- Client-specific notes, annotations, and templates
- Case management tools
- All data stored with specific `client_id` in the database
- Maintains existing functionality

**Navigation Flow:**
```
Login → Session Mode Selection → Client Dashboard → Select Client → Legal Research Tools
```

**Key Pages:**
- `/user-dashboard` - Client selection and management
- `/user/client/{client}/legal-tables` - Client-specific legal document access
- All existing client-based functionality remains unchanged

## Technical Implementation

### New Routes Added

```php
// Session Mode Selection
Route::get('/session-mode-selection', function () {
    return view('session-mode-selection');
})->name('session.mode.selection');

// User-Centric Routes
Route::get('/user-home', [UserCentricController::class, 'home'])->name('user.home');
Route::get('/user-legal-tables', [UserCentricController::class, 'legalTables'])->name('user.legal-tables');
Route::get('/user-notes', [UserCentricController::class, 'notes'])->name('user.notes');
Route::get('/user-templates', [UserCentricController::class, 'templates'])->name('user.templates');
Route::get('/user-immigration-programs', [UserCentricController::class, 'immigrationPrograms'])->name('user.immigration-programs');
Route::get('/user-support', [UserCentricController::class, 'support'])->name('user.support');

// User-Centric Document Viewing
Route::get('/view-user-legal-table/{table_name}', [UserLegalTableController::class, 'showUserDocument'])->name('user.legal-table.show');
Route::get('/view-user-legal-table-french/{table_name}', [UserLegalTableController::class, 'showUserDocumentFrench'])->name('user.legal-table.show.french');

// API Routes for User-Centric Operations
Route::post('/user-notes', [UserCentricController::class, 'storeNote'])->name('user.notes.store');
Route::post('/user-templates', [UserCentricController::class, 'storeTemplate'])->name('user.templates.store');
Route::put('/user-notes/{id}', [UserCentricController::class, 'updateNote'])->name('user.notes.update');
Route::delete('/user-notes/{id}', [UserCentricController::class, 'deleteNote'])->name('user.notes.delete');
```

### New Controllers Created

1. **UserCentricController** - Handles user-centric session operations
2. **UserLegalTableController** - Enhanced with user-centric document viewing methods

### New Views Created

1. **session-mode-selection.blade.php** - Session mode selection page
2. **user-home.blade.php** - User-centric home dashboard
3. **user-centric-legal-tables.blade.php** - Legal tables for personal session
4. **user-notes.blade.php** - Personal notes management
5. **user-templates.blade.php** - Personal template management
6. **user-immigration-programs.blade.php** - Immigration programs information
7. **user-support.blade.php** - Support center

### Database Considerations

**Data Separation:**
- User-centric data: `client_id = null`
- Client-centric data: `client_id = [specific_client_id]`

**Affected Tables:**
- `user_text_data` - Notes and annotations
- `user_popup_data` - Popup data
- `user_templates` - Template data

### Authentication Changes

**AuthenticatedSessionController** updated:
```php
// Changed login redirect from user.dashboard to session.mode.selection
return redirect()->intended(route('session.mode.selection', absolute: false));
```

### Navigation Changes

**Sidebar Navigation Updated:**
- "Home" now points to user-centric home (`/user-home`)
- "Client Selection Mode" now points to client dashboard (`/user-dashboard`)

## Session Context Management

### User-Centric Session
- No client context required
- All operations tied to `Auth::user()->id` only
- Session type: `personal`

### Client-Centric Session
- Requires client selection and context
- All operations tied to both `Auth::user()->id` and `client_id`
- Session type: `client-based`

## Translation Support

Both workflows fully support English/French translation with:
- Data attributes for content translation
- Dynamic language switching
- Placeholder text translation
- Form element translation

## Security Features

- Route middleware protection
- User authentication required
- Data isolation between users
- Client data isolation within user accounts
- SQL injection prevention in table name validation

## Benefits of Dual Workflow

1. **Flexibility**: Users can choose their preferred working mode
2. **Data Organization**: Clear separation between personal and client work
3. **Efficiency**: Quick access to documents without client selection when doing personal research
4. **Client Management**: Dedicated client-centric mode for case management
5. **Backward Compatibility**: Existing client-based functionality preserved

## Usage Scenarios

### Personal Session Use Cases:
- Legal research for personal knowledge
- Preparing for client meetings
- Creating personal reference materials
- Learning about immigration programs
- Building personal template library

### Client Session Use Cases:
- Working on specific client cases
- Creating client-specific documentation
- Managing client communications
- Tracking client case progress
- Generating client reports

## Future Enhancements

1. Session preference saving
2. Quick session switching without full redirect
3. Session-specific dashboards with analytics
4. Collaborative features for client sessions
5. Session-based notification systems

## Migration Notes

- Existing users will see the new session selection page on next login
- All existing client-based data remains accessible through Client Selection Mode
- No data migration required - new user-centric features start fresh
- Existing bookmarks to `/user-dashboard` will continue to work

## Testing Recommendations

1. Test session mode selection and switching
2. Verify data isolation between session types
3. Test user-centric note and template creation
4. Verify client-centric functionality remains unchanged
5. Test authentication redirects
6. Verify translation functionality in both modes
