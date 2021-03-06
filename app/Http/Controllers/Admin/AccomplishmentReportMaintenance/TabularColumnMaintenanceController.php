<?php

namespace App\Http\Controllers\Admin\AccomplishmentReportMaintenance;

use Illuminate\Support\Facades\Auth;
use App\Models\TabularTable;
use App\Models\TabularColumn;

use App\Http\Requests\Admin\AccomplishmentReportMaintenance\TabularColumn\{
    TabularColumnStoreRequest,
    TabularColumnUpdateRequest,
    TabularColumnDeleteRequest,
};
use App\Services\Admin\AccomplishmentReportMaintenance\TabularColumn\{
    TabularColumnStoreService,
    TabularColumnUpdateService,
    TabularColumnDeleteService,
    TabularColumnRestoreService,
};

use App\Services\PermissionServices\PermissionCheckingService;
use App\Services\DataLogServices\DataLogService;

use App\Http\Controllers\Controller as Controller;

class TabularColumnMaintenanceController extends Controller
{
    protected $viewDirectory = 'admin.maintenances.accomplishmentReport.tabularColumn.';
    protected $permissionChecker;
    protected $dataLogger;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->permissionChecker = new PermissionCheckingService();
        $this->dataLogger = new DataLogService();
    }
    
    public function create($tabular_table_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);

        return view($this->viewDirectory . 'create', compact('tabularTable'));
    }

    public function store(TabularColumnStoreRequest $request, $tabular_table_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);

        $message = (new TabularColumnStoreService())->store($tabularTable, $request);

        $this->dataLogger->log(Auth::user()->user_id, Auth::user()->roles->first()->role . ' Created a Tabular AR Column.');

        return redirect()->action(
            [TabularTableMaintenanceController::class, 'show'], ['tabular_table_id' => $tabular_table_id])
            ->with($message);
    }

    public function edit($tabular_table_id, $tabular_column_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);
        $tabularColumn = $this->checkIfTabularColumnExists($tabular_table_id, $tabular_column_id);

        return view($this->viewDirectory . 'edit', compact('tabularTable', 'tabularColumn'));
    }

    public function update(TabularColumnUpdateRequest $request, $tabular_table_id, $tabular_column_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);
        $tabularColumn = $this->checkIfTabularColumnExists($tabular_table_id, $tabular_column_id);

        $message = (new TabularColumnUpdateService())->update($tabularTable, $tabularColumn, $request);

        $this->dataLogger->log(Auth::user()->user_id, Auth::user()->roles->first()->role . ' Updated a Tabular AR Column.');

        return redirect()->action(
            [TabularTableMaintenanceController::class, 'show'], ['tabular_table_id' => $tabular_table_id])
            ->with($message);

    }

    public function show($tabular_table_id, $tabular_column_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);
        $tabularColumn = $this->checkIfTabularColumnExists($tabular_table_id, $tabular_column_id);
        
        return view($this->viewDirectory . 'show', compact('tabularTable', 'tabularColumn'));
    }

    public function destroy(TabularColumnDeleteRequest $request, $tabular_table_id, $tabular_column_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularTable = $this->checkIfTabularTableExists($tabular_table_id);
        $tabularColumn = $this->checkIfTabularColumnExists($tabular_table_id, $tabular_column_id);

        $message = (new TabularColumnDeleteService())->delete($tabularTable, $tabularColumn, $request);

        $this->dataLogger->log(Auth::user()->user_id, Auth::user()->roles->first()->role . ' Deleted a Tabular AR Column.');

        return redirect()->action(
            [TabularTableMaintenanceController::class, 'show'], ['tabular_table_id' => $tabular_table_id])
            ->with($message);
    }

    public function restore($tabular_table_id, $tabular_column_id)
    {
        abort_if(! $this->permissionChecker->checkIfPermissionAllows('AR-Super-Admin-Manage_Accomplishment_Report'), 403);
        $tabularColumn = $this->checkIfTabularColumnExists($tabular_table_id, $tabular_column_id);

        $message = (new TabularColumnRestoreService())->restore($tabularColumn);

        $this->dataLogger->log(Auth::user()->user_id, Auth::user()->roles->first()->role . ' Restored a Tabular AR Column.');

        return redirect()->action(
            [TabularTableMaintenanceController::class, 'show'], ['tabular_table_id' => $tabular_table_id])
            ->with($message);

    }

    /**
     * @param Integer $tabular_table_id, Integer $tabular_column_id
     * Function to check if a tabular column id exists, sends 404 if not
     * @return Collection
     */ 
    private function checkIfTabularColumnExists($tabular_table_id, $tabular_column_id)
    {
        abort_if(! $tabularColumn = TabularColumn::withTrashed()->where('tabular_column_id', $tabular_column_id)->where('tabular_table_id', $tabular_table_id)->first(), 404);

        return $tabularColumn;
    }

    /**
     * @param Integer $tabular_table_id
     * Function to check if a tabular table id exists, sends 404 if not
     * @return Collection
     */ 
    private function checkIfTabularTableExists($tabular_table_id)
    {
        abort_if(! $tabularTable = TabularTable::withTrashed()->where('tabular_table_id', $tabular_table_id)->first(), 404);

        return $tabularTable;
    }
}
