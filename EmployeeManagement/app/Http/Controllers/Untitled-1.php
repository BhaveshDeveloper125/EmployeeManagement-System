namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
public function index()
{
$records = AttendanceRecord::where('employee_id', Auth::id())->get();
return view('attendance.index', compact('records'));
}

public function punchAttendance(Request $request)
{
$employee = Auth::user();
$ipAddress = $request->ip();
$officeIp = '192.168.1.1'; // Replace with actual office IP
$officeSsid = 'Office_WiFi'; // Replace with actual office SSID

// Get Wi-Fi SSID using JS or external service (passed from frontend)
$wifiSsid = $request->input('wifi_ssid');

$isOnTime = now()->format('H:i:s') <= '10:30:00' ;
     $isValidNetwork=$ipAddress===$officeIp && $wifiSsid===$officeSsid;

     if (!$wifiSsid) {
     return response()->json([
     'status' => 'error',
     'message' => 'Wi-Fi SSID not detected. Please ensure you are connected to the office network.',
     ], 400);
     }

     AttendanceRecord::create([
     'employee_id' => $employee->id,
     'ip_address' => $ipAddress,
     'wifi_ssid' => $wifiSsid,
     'punched_at' => now(),
     'is_on_time' => $isValidNetwork && $isOnTime,
     ]);

     return response()->json([
     'status' => $isValidNetwork ? 'success' : 'error',
     'message' => $isValidNetwork ? 'Attendance marked successfully' : 'Invalid network. Please connect to the office Wi-Fi.',
     ]);
     }
     }